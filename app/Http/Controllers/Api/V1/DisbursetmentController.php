<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disbursetment;
use App\Models\Investment;
use App\Models\Customer;


use Illuminate\Support\Facades\DB;
use App\Utils\Util;

class DisbursetmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $request_answer = DB::transaction(function () use($request){
            
            $fields = $request->validate([
                'id_disbursement_type' => 'required|numeric',
                'id_customer' => 'required|numeric',
                //'value_consign' => 'required|numeric',
                //'monthtly_return' => 'required|numeric'

            ]);

            switch ($fields['id_disbursement_type']){//Tipos de desembolso
                
                case '1'://Rentabilidad Mensual

                    //generar informe de desembolso
                    //cargar informe de desembolso 
                    

                    break;
                case '2'://Capital Parcial

                        //Generar informe de desembolso Capital Parcial
                        //valor a consignar y demás datos

                    break;
                
                case '3'://Capital Total
                   
                    $total_invested = Investment::getTotalInvestmentCustomer($fields['id_customer']);

                    return array(404, $total_invested);
                    
                    $investment = DB::table('investments')
                    ->select(DB::raw('id, percentage_investment'))
                    ->where('id_customer',$fields['id_customer'])
                    ->where('status',1)
                    ->first();

                    if($investment){

                         //Se crea el extracto
                        $requestModel = Disbursetment::create([

                            'id_customer' => $fields['id_customer'],
                            'id_disbursement_type' => $fields['id_disbursement_type'],
                            'value_consign' =>  $total_invested,
                            'monthly_return' => $investment->percentage_investment,
                
                        ]);
                        
                        //Se coloca el estado 2(desembolsadas) las inversiones activas del cliente.
                        DB::statement(" UPDATE investments I 
                        INNER JOIN customers C ON C.id = I.id_customer 
                        SET I.status=2
                        WHERE C.id=? AND I.status=1",
        
                        [$fields['id_customer']]);

                        //Se inactiva el cliente
                        $customer = Customer::find($fields['id_customer']);
                        $customer->status = 0;
                        $customer->save();

                        //Se genera el PDF.

                        Util::downloadPDF();

                        if($customer->save()){
                            return array(201, 'Se ha creado el desembolso de manera correcta.');

                        }else{
                            return array(501, 'Ha ocurrido un error al intentar realizar el proceso de desembolso.');
                        }
                    }else{
                        return array(401, 'No se han encontrado inversiones activas para este cliente.');
                    }
                   

                    
                    break;
            }


        }, 3); 
    
            return Util::setResponseJson($request_answer[0], $request_answer[1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

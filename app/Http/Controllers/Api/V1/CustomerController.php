<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Utils\Util;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredentialsMailable;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Http\Traits\InvestmentTrait;

class CustomerController extends Controller
{

    use InvestmentTrait;


    public function index()
    {
        return new CustomerCollection(Customer::where('status',1)->get());
        
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $customer = DB::transaction(function () use($request){

                //Se validan que los campos del cliente obligatorios no estén vacíos.
                $fields = $request->validate([
                    'name' => 'required|string',
                    'last_name' => 'required|string',
                    'phone' => 'required|numeric',
                    'address' => 'required|string',
                    'city' => 'required|string',
                    'department' => 'required|string',
                    'country' => 'required|string',
                    'document_number' => 'required|numeric|unique:customers',
                    'file_document' => 'required|string',
                    'email' => 'required|string|unique:users,email',
                    'id_rol' => 'required|numeric',
                ]);
                
                //Se calcula la clasificación del cliente dependiendo del monto de la inversión.
                $customer_level = Util::validateCustomerLevel($request->amount);
                //Se genera una contraseña aleatoria.
                $password = Util::generatePassword();
                
                //Se genera un código personal único, a partir del correo del cliente.
                $personal_code = Util::generatePersonalCode($fields['email']);

                //Se crea el usuario
                $user = User::create([
                    'name' => $fields['name']." ".$fields['last_name'],
                    'email' => $fields['email'],
                    'password' => bcrypt($password),
                    'id_rol' => $fields['id_rol'],
                    'personal_code' => $personal_code
        
                ]);
                

                //Se crea el cliente.
                $customer = Customer::create([
                    'id_user' => $user->id,
                    'name' => $fields["name"],
                    'last_name' => $fields["last_name"],
                    'phone' => $fields["phone"],
                    'address' => $fields["address"],
                    'city' => $fields["city"],
                    'department' => $fields["department"],
                    'country' => $fields["country"],
                    'document_number' => $fields["document_number"],
                    'file_document' => $fields["file_document"],
                    'description_ind' => $request->description_ind,
                    'file_rut' => $request->file_rut,
                    'business' => $request->business,
                    'position_business' => $request->position_business,
                    'antique_bussiness' => $request->antique_bussiness,
                    'type_contract' => $request->type_contract,
                    'work_certificate' => $request->work_certificate,
                    'pension_fund' => $request->pension_fund,
                    'especification_other' => $request->especification_other,
                    'account_number' => $request->account_number,
                    'account_type' => $request->account_type,
                    'bank_name' => $request->bank_name,
                    'account_certificate' => $request->account_certificate,
                    'document_third' => $request->document_third,
                    'name_third' => $request->name_third,
                    'letter_authorization_third' => $request->letter_authorization_third,
                    'kinship_third' => $request->kinship_third,
                    'rut_third' => $request->rut_third,
                    'id_document_type' => $request->id_document_type,
                    'id_economic_activity' => $request->id_economic_activity,
                    'id_bank_account' => $request->id_bank_account,
                    'customer_level' => $customer_level
                ]);
                
                //Se usa el Trait InvestmentTrait para guardar la información de la inversión
                $this->storeInvestment($request, $customer->id);

               
                $dataCustomer["email"] =  $fields['email'];
                $dataCustomer["title"] = "Te damos la bienvenida a VIP World Trading";
                $dataCustomer["code"] = $personal_code; 
                $dataCustomer["password"] = $password;
                
                //Se envían las credenciales del cliente al correo
                Util::sendCredentialsEmail($dataCustomer);
              
                
                return $customer;
            
        }, 3); 
        
        return Util::setResponseJson(201, $customer);
  
    }


    public function show($id)
    {
        return new CustomerResource(Customer::find($id));
    }

    
    public function edit(Customer $customer)
    {
        //
    }

   
    public function update(Request $request, Customer $customer)
    {
        //
    }

   
    public function destroy(Customer $customer)
    {
        //
    }

    
    public function getCustomers($param){
       
        return new CustomerCollection(Customer::searchCustomerByParams($param));

    }
}

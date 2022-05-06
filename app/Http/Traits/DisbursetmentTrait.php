<?php

namespace App\Http\Traits;

use App\Models\Disbursetment;


use Illuminate\Support\Facades\DB;

trait DisbursetmentTrait
{

    public function storeDisbursetment($request){

        $extract = Disbursetment::create([
                    
            'id_customer' =>$request['id_customer'],
            'id_disbursement_type' => $request['id_disbursement_type'],
            'value_consign' => $request['disbursement_amount'],
            'month' => date('m'),
            'date_create' => date('Y-m-d'),
            'ind_done' => $request['ind_done'],
            'disbursetment_file' => $request['disbursetment_file'],

        ]);

        return $extract;


    }

    


    

}
<?php

namespace App\Http\Traits;

use App\Models\Extract;
use App\Models\ExtractDetail;


use Illuminate\Support\Facades\DB;

trait ExtractTrait
{

    public function storeExtract($request){

        $extract = Extract::create([
            'id_customer' =>$request['id_customer'],
            'total_disbursed' => $request['total_disbursed'],
            'total_reinvested' => $request['total_reinvested'],
            'profitability_percentage' => $request['profitability_percentage'],
            'grand_total_invested' => $request['grand_total_invested'],
            'registered_by' => $request['registered_by'],
            'month' => $request['month']

        ]);

        return $extract;

    }

    public function storeExtractDetail($request){

        $extract_details = ExtractDetail::create([
            'id_extract' => $request['id_extract'],
            'id_investment' => $request['id_investment'],
            'monthly_profitability_percentage' => $request['monthly_profitability_percentage'],
            'profitability_days' => $request['profitability_days'],
            'month' => $request['month'],
            'real_profitability_percentage' => $request['real_profitability_percentage'],
            'investment_amount' => $request['investment_amount'],
            'investment_return' => $request['investment_return'],
        ]);

        return $extract_details;

    }


    

}
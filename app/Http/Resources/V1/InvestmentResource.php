<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'base_amount' => number_format($this->base_amount, 0,',',"."),
            'amount' =>  number_format($this->amount, 0,',',"."),
            'disbursement_amount' =>  number_format($this->amount_disbursement, 0,',',"."),
            'initial_amount' =>  number_format($this->initial_amount, 0,',',"."),
            'currency' => $this->code_currency,
            'percentage_investment' => $this->percentage_investment,
            'customer' => [
                'name' => $this->customer->name,
                'lastname' => $this->customer->last_name,
            ],
            'id_payment_method' => $this->id_payment_method,
            'payment_method' => $this->paymentMethod->name,
            'id_investment_type' => $this->id_investment_type,
            'investment_type' => $this->investmentType->name,
            'investment_date' => $this->investment_date,
            'profitability_start_date' => $this->profitability_start_date,
            'consignment_file' => $this->consignment_file,
            'registered_by' => $this->registeredBy->name,
            'status' => $this->status_text,
            'extract_detail' => $this->extractDetails,
       
        ];
    }
}

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
            'base_amount' => $this->base_amount,
            'amount' => $this->amount,
            'currency' => $this->code_currency,
            'customer' => [
                'name' => $this->customer->name,
                'lastname' => $this->customer->last_name,
            ],
            'payment_method' => $this->paymentMethod->name,
            'investment_type' => $this->investmentType->name,
            'investment_date' => $this->investment_date,
            'registered_by' => $this->registeredBy->name,
            'status' => $this->status_text
        ];
    }
}

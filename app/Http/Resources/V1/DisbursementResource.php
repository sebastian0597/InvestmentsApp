<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DisbursementResource extends JsonResource
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
            'id_customer' => $this->id_customer,
            'id_disbursement_type' => $this->id_disbursement_type,
            'disbursement_type' => $this->disbursementType->name,
            'month' => $this->month,
            'quantity' => $this->quantity = null ? 0 : $this->quantity,
            'ind_done' => $this->ind_done,
            'id_customer_type' => $this->id_customer_type,
            'value_consign' => $this->value_consign == null  ? 0 : $this->value_consign,
            'date' => $this->fecha  == null ? 0 : $this->fecha,
            'date_create' => $this->date_create,
            'date_disbursement' => $this->date_disbursement,
            'created_at' => $this->created_at->format('Y/m/d'),
            'disbursetment_file' => $this->disbursetment_file,
            'customer' => [
                'fullname' => $this->customer->name.' '.$this->customer->last_name,
                'document_number' => $this->customer->document_number,
            ],
            'status' => $this->done,

        ];
    }
}

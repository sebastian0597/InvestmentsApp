<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ExtractResource extends JsonResource
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
            'total_disbursed' =>  $this->total_disbursed,
            'total_reinvested' => $this->total_reinvested,
            'profitability_percentage' => $this->profitability_percentage,
            'grand_total_invested' => $this->grand_total_invested,
            'total_profitability' => $this->total_profitability,
            'status' => $this->status,
            'registered_by' => $this->registered_by,
            'month' => $this->month,
            'created_at' => $this->created_at,
            'extract_detail' => $this->extractDetail,
        ];
    }
}

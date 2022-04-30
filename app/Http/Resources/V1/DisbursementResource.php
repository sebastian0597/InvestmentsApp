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

            'cantidad' => $this->cantidad = null ? 0 : $this->cantidad,
            'id_customer_type' => $this->id_customer_type,
            'value_consign' => $this->value_consign == null  ? 0 : $this->value_consign,
            'fecha' => $this->fecha  == null ? 0 : $this->fecha,
         
        ];
    }
}

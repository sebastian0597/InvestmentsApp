<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class KPIResource extends JsonResource
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
            'status' => $this->status,
            'id_customer_type' => $this->id_customer_type,
            'inversiones' => $this->inversiones == null  ? 0 : $this->inversiones,
            'total_rentabilidad' => $this->total_rentabilidad  == null ? 0 : $this->total_rentabilidad,
            'total_disbursed' => $this->total_disbursed == null ? 0 : $this->total_disbursed

        ];
    }
}

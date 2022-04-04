<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'id_rol' => $this->id_rol,
            'ind_status' => $this->status,
            'status' => $this->status_text,
            'roles' => [
                'role' => $this->rol->rol,
                'ind_admin' => $this->rol->ind_admin_rol,
                'status' => $this->rol->status,
                ]
        ];
    }
}

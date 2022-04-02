<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'request_date' => $this->request_date,
            'description' => $this->description,
            'answer_date' => $this->answer_date,
            'request_type' => $this->requesType->name,
            'status' => $this->status_text,
            'requested_at' => $this->requested_at,
            'customer' =>[
                'name' => $this->customer->name,
                'last_name' => $this->customer->last_name,
                'document_number' => $this->customer->document_number,
                'customer_type' => $this->customer->customerType->name
            ],
            'date' => $this->date_request,
            'hour' => $this->hour
            /*'user_attend' =>[
                'name' => $this->userAttend->name,
            ]*/
        ];
    }
}

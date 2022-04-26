<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'id' =>  $this->id,
            'id_user'=> $this->id_user,
            'name'=> $this->name,
            'last_name'=> $this->last_name,
            'id_document_type'=> $this->id_document_type,
            'document_number'=> $this->document_number,
            'phone'=> $this->phone,
            'address'=> $this->address,
            'email' => $this->user->email,
            'city'=> $this->city,
            'department'=> $this->department,
            'country'=> $this->country,
            'file_document'=> $this->file_document,
            'description_ind'=> $this->description_ind,
            'file_rut'=> $this->file_rut,
            'business'=> $this->business,
            'position_business'=> $this->position_business,
            'antique_bussiness'=> $this->antique_bussiness,
            'type_contract'=> $this->type_contract,
            'work_certificate'=> $this->work_certificate,
            'pension_fund'=> $this->pension_fund,
            'especification_other'=> $this->especification_other,
            'status'=> $this->status_text,
            'account_number'=> $this->account_number,
            'account_type'=> $this->account_type,
            'bank_name'=> $this->bank_name,
            'account_certificate'=> $this->account_certificate,
            'document_third'=> $this->document_third,
            'name_third'=> $this->name_third,
            'letter_authorization_third'=> $this->letter_authorization_third,
            'kinship_third'=> $this->kinship_third,
            'rut_third'=> $this->rut_third,
            'customer_type'=> $this->customerType->name,
            'id_economic_activity'=> $this->id_economic_activity,
            'id_bank_account'=> $this->id_bank_account,
            'registered_at' => $this->registered_date,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'document_type' => $this->documentType->name,
            'economic_activity' => $this->economicActivity->name,
            'name_bank_account' => $this->bank->name,
            'investments' => $this->investsments,
            'total_investments' => number_format($this->investsments->sum('amount'), 2,',',"."),
            'extract' => $this->extract        
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'last_name',
        'phone',
        'address',
        'city',
        'department',
        'country',
        'file_document',
        'description_ind',
        'file_rut',
        'business',
        'position_business',
        'antique_bussiness',
        'type_contract',
        'work_certificate',
        'pension_fund',
        'especification_other',
        'account_number',
        'account_type',
        'bank_name',
        'account_certificate',
        'document_third',
        'name_third',
        'letter_authorization_third',
        'kinship_third',
        'rut_third',
        'id_document_type',
        'id_economic_activity',
        'id_bank_account'

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtractDetail extends Model
{
    use HasFactory;
    protected $table = 'extracts_details';
    
    protected $fillable = [
        'id_extract',
        'id_investment',
        'monthly_profitability_percentage',
        'profitability_days',
        'real_profitability_percentage',
        'investment_return',
        'investment_amount'
    ];

}

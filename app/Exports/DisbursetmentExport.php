<?php
namespace App\Exports;

use App\Models\Extract;
use Maatwebsite\Excel\Concerns\FromCollection;

class DisbursetmentExport implements FromCollection
{

    protected $extracts;

    function __construct($extracts) {
            $this->extracts = $extracts;
    }
    public function collection()
    {
        return $this->extracts;
    }
}
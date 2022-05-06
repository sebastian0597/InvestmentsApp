<?php
namespace App\Exports;

use App\Models\Extract;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DisbursetmentExport implements FromCollection,WithStyles,WithHeadings,WithColumnFormatting,WithColumnWidths
{

    protected $extracts;

    function __construct($extracts) {
            $this->extracts = $extracts;
    }
    public function collection()
    {
        return $this->extracts;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            'K' => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return ["Nombres", "Apellidos", "Documento", "Teléfono","Número de cuenta", "Tipo de cuenta", "Banco", "Tipo de cliente", "Total inversión", "Porcentaje rentabilidad", "Monto a desembolsar", "Desembolsado"];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_CURRENCY_USD,
            //'J' => NumberFormat::FORMAT_PERCENTAGE,
            'K' => NumberFormat::FORMAT_CURRENCY_USD,
            
            
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,    
            'C' => 30,   
            'D' => 30,    
            'E' => 30,  
            'F' => 30,  
            'G' => 30,  
            'H' => 30,  
            'I' => 30,  
            'J' => 30,  
            'K' => 30, 

        ];
    }
}
<?php

namespace App\Exports;
 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class ExamExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $reportData = [];
        foreach ($this->data as $value) {
                $data['username'] = $value->exam->title;
                $data['question'] = $value->question;
                $data['option1'] = $value->option1;
                $data['option2'] = $value->option2;
                $data['option3'] = $value->option3;
                $data['option4'] = $value->option4;
                $data['answer'] = $value->answer;
           
                $reportData[] = $data;
        }
        return collect($reportData);       
    }
    
    /*
    * Set heading of excel sheet
    */
    public function headings() : array
    {
         return [            
            'username',
            'question',
            'option1',
            'option2',
            'option3',
            'option4',
            'answer',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    
    
    
}

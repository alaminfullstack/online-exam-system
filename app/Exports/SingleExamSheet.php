<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SingleExamSheet implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->data['Examiners']);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Examiner Name', 'Mobile', 'ID',
        ];
    }
}
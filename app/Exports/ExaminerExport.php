<?php

namespace App\Exports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExaminerExport implements FromCollection, WithHeadings, WithMultipleSheets
{
    protected $examId;

    public function __construct($examId)
    {
        $this->examId = $examId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $exam = Exam::findOrFail($this->examId);

        $data = [
            'Exam Title' => $exam->title,
            'Examiners' => $exam->examiners->map(function ($examiner) {
                return [
                    'Name' => $examiner->name,
                    'Mobile' => $examiner->mobile,
                    'ID' => $examiner->uid,
                ];
            })->toArray(),
        ];

        return collect($data);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return []; // No headings for the main sheet
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            $this->examId => new SingleExamSheet($this->collection()),
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Examiner;
use Illuminate\Http\Request;
use App\Exports\ExaminerExport;
use Maatwebsite\Excel\Facades\Excel;

class ExaminerController extends Controller
{
    public function index(Request $request)
    {
        $exam = null;
        if ($request->has('exam_id')) {
            $exam_id = $request->exam_id;
            $exam = Exam::findOrFail($exam_id); 
            $examiners = $exam->examiners()->paginate(); 
        }else{
            $examiners = Examiner::latest()->paginate(); 
        }

        // Fetch all examiners from database
        return view('backend.examiners.index', compact('examiners', 'exam'));
    }

    public function export(Request $request)
    {
       
        if ($request->has('exam_id')) {
            $exam_id = $request->exam_id;
            $exam = Exam::findOrFail($exam_id); 
            $slug = $exam->slug;
            return Excel::download(new ExaminerExport($exam_id), "exam_({$slug})_examiners.xlsx");
        }

        return back()->with('error', 'Something went to wrong!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function online_exam($slug){
        $exam = Exam::where('status', 1)->where('slug', $slug)->firstOrFail();
        $questions = $exam->questions;

        return view('online_exam', compact('exam', 'questions'));
    }


}

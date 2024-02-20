<?php

namespace App\Http\Controllers;

use App\Models\Examiner;
use Illuminate\Http\Request;

class ExaminerController extends Controller
{
    public function index()
    {
        $examiners = Examiner::latest()->paginate(); // Fetch all examiners from database
        return view('backend.examiners.index', compact('examiners'));
    }
}

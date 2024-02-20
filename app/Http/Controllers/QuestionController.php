<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('exam_id')) {
            $exam_id = $request->exam_id;
            $questions = Question::where('exam_id', $exam_id)->get(); // Fetch all questions from database
            return view('backend.questions.index', compact('questions','exam_id'));
        }

        return back();
    }

    public function create(Request $request)
    {
        if ($request->has('exam_id')) {
            $exam_id = $request->exam_id;
            return view('backend.questions.create', compact('exam_id'));
        }

        return back();
    }

    public function store(Request $request)
    {
       
        $data = $this->validateRequest($request); // Validate request data

        Question::create([
            'question_title' => $data['question_title'],
            'option_1' => $data['option_1'],
            'option_2' => $data['option_2'],
            'option_3' => $data['option_3'],
            'option_4' => $data['option_4'],
            'correct_option' => $data['correct_option'],
            'exam_id' => $data['exam_id'],
        ]);

        return redirect()->route('admin.questions.index', ['exam_id' => $request->exam_id])->with('success', 'Question created successfully!');
    }

    public function edit(Question $question)
    {
        return view('backend.questions.edit', compact('question')); // Edit form for an existing question
    }

    public function update(Request $request, Question $question)
    {
        $data = $this->validateRequest($request); // Validate request data
        $question->update([
            'question_title' => $data['question_title'],
            'option_1' => $data['option_1'],
            'option_2' => $data['option_2'],
            'option_3' => $data['option_3'],
            'option_4' => $data['option_4'],
            'correct_option' => $data['correct_option'],
            'exam_id' => $data['exam_id'],
        ]);

        return redirect()->route('admin.questions.index', ['exam_id' => $request->exam_id])->with('success', 'Question updated successfully!');
    }

    public function destroy(Question $question)
    {
        $question->delete(); // Delete question from database
        return back();
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'question_title' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'option_4' => 'required',
            'correct_option' => 'required',
            'exam_id' => 'required',
        ]);
    }
}

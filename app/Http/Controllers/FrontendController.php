<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Answer;
use App\Models\Banner;
use App\Models\ExamAttender;
use App\Models\Examiner;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function online_exam(Request $request, $slug)
    {
        $exam = Exam::where('status', 1)->where('slug', $slug)->firstOrFail();
        $questions = $exam->questions;

        $ip = $request->ip();
        $examiner = Examiner::where('ip', $ip)->first();

        return view('online_exam', compact('exam', 'questions','examiner'));
    }

    public function online_exam_submit(Request $request, $slug)
    {


        $ip = $request->ip();
        $uid = time();

        $exam = Exam::where('status', 1)->where('slug', $slug)->firstOrFail();

        $examiner = Examiner::where('ip', $ip)->first();

        if($examiner == null){
            $examiner = new Examiner();
            $examiner->uid = $uid;
            $examiner->ip = $ip;
        }

       
        $examiner->name = $request->name;
        $examiner->mobile = $request->mobile;
        $examiner->save();

        // save exam attender
        $exam_attender = new ExamAttender();
        $exam_attender->exam_id = $exam->id;
        $exam_attender->examiner_id = $examiner->id;
        $exam_attender->save();

        $examiner_id = $examiner->uid;
        $exam_id = $exam->id;

        if ($request->question == null) {
            return redirect()->back()->with('error', 'Are You joking. Why submit exam until without any answer?');
        }

        if ($exam->exam_type == 'mcqx') {
            foreach ($request->question as $q_id => $answer) {
                $arr_ans = $answer;

                if (is_array($answer)) {
                    $arr_ans = json_encode($answer);
                }

                $exam_answer = new Answer();
                $exam_answer->exam_id = $exam_id;
                $exam_answer->examiner_uid = $examiner_id;
                $exam_answer->question_id = $q_id;
                $exam_answer->correct_answer = $arr_ans;
                $exam_answer->save();
            }
        } else {
            foreach ($request->question as $q_id => $answer) {
                $exam_answer = new Answer();
                $exam_answer->exam_id = $exam_id;
                $exam_answer->examiner_uid = $examiner_id;
                $exam_answer->question_id = $q_id;
                $exam_answer->correct_answer = $answer;
                $exam_answer->save();
            }
        }

        return redirect()->route('result', [$slug, $examiner_id]);
    }


    public function result($slug, $examiner)
    {
        $exam = Exam::where('status', 1)->where('slug', $slug)->firstOrFail();
        $examin = Examiner::where('uid', $examiner)->first();

        $examiner_id = $examiner;
        $answers =  $exam->answers()->where('examiner_uid', $examiner_id)->pluck('correct_answer', 'question_id')->toArray();
        $questions = $exam->questions;
        $first_banner = Banner::latest()->first();
        $last_banner = Banner::oldest()->first();

        $total_questions = count($questions);
        $score = 0;
        $total_correct = 0;
        $correct_percent = 0;
        $wrong_percent = 0;
        $score_percent = 0;

        if ($exam->exam_type == 'mcqx') {
            foreach ($exam->questions as $question) {
                if (array_key_exists($question->id, $answers)) {

                    $question_correct_answer = json_decode($question->correct_option);
                    $user_correct_answer = json_decode($answers[$question->id]);

                    $question_correct_count = count($question_correct_answer);
                    $user_correct_count = count($user_correct_answer);

                    $mark = 1 / $question_correct_count;
                    $get_mark = 1;

                    if ($question_correct_count >= $user_correct_count) {
                        $wrong_count = count(array_diff($question_correct_answer, $user_correct_answer));
                    } else {
                        $wrong_count = count(array_diff($user_correct_answer, $question_correct_answer));
                    }

                    for ($i = 0; $i < $wrong_count; $i++) {
                        $get_mark -= $mark;
                    }

                    $score += $get_mark;
                    
                }
            }
        } else {
            foreach ($exam->questions as $question) {
                if (array_key_exists($question->id, $answers)) {
                    if ($question->correct_option == $answers[$question->id]) {
                        $score += 1;
                        $total_correct += 1;
                    }
                }
            }
        }

        $total_wrong = $total_questions - $total_correct;

        if($total_correct > 0){
            $correct_percent = $total_correct / $total_questions * 100;
        }

        if( $total_wrong > 0){
            $wrong_percent = $total_wrong / $total_questions *  100;
        }

        if($score > 0){
            $score_percent = $score / $exam->total_mark * 100;
        }


        return view('result', compact('exam', 'answers', 'questions','first_banner','last_banner','examin','score', 'total_correct', 'total_wrong', 'correct_percent','wrong_percent', 'score_percent','total_questions'));
    }

    public function result_details($slug, $examiner)
    {
        $exam = Exam::where('status', 1)->where('slug', $slug)->firstOrFail();
        $examin = Examiner::where('uid', $examiner)->first();

        $examiner_id = $examiner;
        $answers =  $exam->answers()->where('examiner_uid', $examiner_id)->pluck('correct_answer', 'question_id')->toArray();
        $questions = $exam->questions;
        $first_banner = Banner::latest()->first();
        $last_banner = Banner::oldest()->first();

        $total_questions = count($questions);
        $score = 0;
        $total_correct = 0;
        $correct_percent = 0;
        $wrong_percent = 0;
        $score_percent = 0;

        if ($exam->exam_type == 'mcqx') {
            foreach ($exam->questions as $question) {
                if (array_key_exists($question->id, $answers)) {

                    $question_correct_answer = json_decode($question->correct_option);
                    $user_correct_answer = json_decode($answers[$question->id]);

                    $question_correct_count = count($question_correct_answer);
                    $user_correct_count = count($user_correct_answer);

                    $mark = 1 / $question_correct_count;
                    $get_mark = 1;

                    if ($question_correct_count >= $user_correct_count) {
                        $wrong_count = count(array_diff($question_correct_answer, $user_correct_answer));
                    } else {
                        $wrong_count = count(array_diff($user_correct_answer, $question_correct_answer));
                    }

                    for ($i = 0; $i < $wrong_count; $i++) {
                        $get_mark -= $mark;
                    }

                    $score += $get_mark;
                    
                }
            }
        } else {
            foreach ($exam->questions as $question) {
                if (array_key_exists($question->id, $answers)) {
                    if ($question->correct_option == $answers[$question->id]) {
                        $score += 1;
                        $total_correct += 1;
                    }
                }
            }
        }

        $total_wrong = $total_questions - $total_correct;

        if($total_correct > 0){
            $correct_percent = $total_correct / $total_questions * 100;
        }

        if( $total_wrong > 0){
            $wrong_percent = $total_wrong / $total_questions *  100;
        }

        if($score > 0){
            $score_percent = $score / $exam->total_mark * 100;
        }


        return view('result_details', compact('exam', 'answers', 'questions','first_banner','last_banner','examin','score', 'total_correct', 'total_wrong', 'correct_percent','wrong_percent', 'score_percent','total_questions'));
    }
}

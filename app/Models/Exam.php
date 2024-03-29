<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $guarded = [];

    /**
     * Get all of the questions for the Exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id', 'id');
    }

    /**
     * Get all of the answers for the Exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'exam_id', 'id');
    }

    /**
     * Get all of the examiners for the Exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function examiners()
    {
        return $this->hasManyThrough(Examiner::class, ExamAttender::class, 'exam_id', 'id');
    }
}

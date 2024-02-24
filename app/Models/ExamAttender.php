<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttender extends Model
{
    use HasFactory;
    protected $table = 'exam_attenders';
    protected $guarded = [];

    /**
     * Get the examiner that owns the ExamAttender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examiner()
    {
        return $this->belongsTo(Examiner::class, 'examiner_id', 'id');
    }

    /**
     * Get the exam that owns the ExamAttender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}

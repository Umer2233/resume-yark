<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'id',
        'question',
        'job_seeker_tip',
        'employer_tip',
        'quality',
        'quality_code',
        'quality_description',
        'is_Active',
        'profile_question',
    ];

    public function PositionQuestion()
    {
        return $this->belongsTo('App\PositionQuestion', 'id', 'question_id');
    }

}

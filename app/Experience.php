<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';
    protected $fillable = ['id', 'user_id', 'question_id', 'position_id', 'job_id', 'result_id', 'description', 'status','created_at', 'updated_at'];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function resume_experience()
    {
        return $this->hasOne(ResumeExperience::class,'experience_id');
    }

}
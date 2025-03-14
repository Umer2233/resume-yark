<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endorsement extends Model
{
    protected $table = 'endorsement';
    protected $fillable = ['user_id','top_endorsment_status', 'job_id', 'result_id', 'value', 'type', 'author', 'author_description', 'status'];
    protected $guarded = [];
     public function job()
    {

        return $this->belongsTo(job::class);
    }

    public function subsection_content_type()
    {
        return $this->morphMany(EduSubSectionContent::class, 'subsection_content_able');
    }

     public function jobs()
    {
        return $this->belongsTo(Job::class, 'job_id','id');
    }
}
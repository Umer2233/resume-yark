<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeSectionJob extends Model
{
    protected $table = 'resumesection_job';

 protected $fillable = [
        'resumesection_id',
        'job_id',
        'orderBy',
        'active',
        'description_override',
        'order',
        'hidden',
        'endorsement_id',
        'created_at',
        'updated_at'
    ];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }



}
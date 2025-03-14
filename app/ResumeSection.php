<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeSection extends Model
{
    protected $table = 'resumesection';
    protected $fillable = [
        'resume_id',
        'title',
        'content',
        'type',
        'column',
        'order',
        'hidden',
        'endorsement_id',
        'created_at',
        'updated_at'
    ];

    public function resumeSectionJob()
    {
        return $this->hasMany(ResumeSectionJob::class, 'resumesection_id', 'id')->orderBy('order');
    }
    
    public function resumeSubSection()
    {
        return $this->hasMany(ResumeSubSection::class, 'resumesection_id', 'id')->orderBy('order');
    }
}
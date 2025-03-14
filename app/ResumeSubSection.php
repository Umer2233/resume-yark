<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeSubSection extends Model
{
    use HasFactory;
    protected $table = "resumesubsection";
    protected $fillable = ['resumesection_id', 'status','title', 'content','order','list_style','hidden','created_at','updated_at'];
    
    public function eduSubSectionContent()
    {
        return $this->hasMany(EduSubSectionContent::class, 'resume_subsection_id', 'id');
    }
    
     public function resumeExperience()
    {
        return $this->hasMany(ResumeExperience::class, 'resumesubsection_id', 'id');
    }
}
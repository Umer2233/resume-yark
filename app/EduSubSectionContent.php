<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduSubSectionContent extends Model
{
    use HasFactory;
    protected $table = 'edu_subsection_contents';
    protected $fillable = [
        'resume_subsection_id',
        'type',
        'user_id',
    	'subsection_content_able_id',
        'subsection_content_able_type',
        'orderBy',
    	'status'
    ];


 public function subsection_content_able()
    {
        return $this->morphTo();
    }
}
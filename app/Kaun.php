<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaun extends Model
{
    use HasFactory;
    protected $table = "kaun";
    protected $fillable = ['user_id', 'overallgpa',	'majorgpa',	'minor', 'credits_completed', 'academic_achievement',	'clubs_organization'];

    public function subsection_content_type()
    {
        return $this->morphMany(EduSubSectionContent::class, 'subsection_content_able');
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeExperience extends Model
{
    use HasFactory;
    protected $table = 'resume_experience';
    protected $fillable = [ 'order','created_at', 'updated_at','resumesubsection_id'];

    public function resume_experience()
    {
        return $this->belongsTo(Experience::class,'experience_id');
    }
     public function resume()
    {
        return $this->belongsTo(Resume::class,'resume_id');
    }
    public function experience()
    {
        return $this->belongsTo(Experience::class,'experience_id');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    use HasFactory;
    protected $table = 'job_descriptions';

     public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

     public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
}
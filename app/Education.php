<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
    'user_id',
    'school',
    'school_id',
    'city',
    'state',
    'country',
    'degree',
    'major',
    'grad_month',
    'grad_year',
    'overallgpa',
    'majorgpa',
    'credits_completed',
    'orderBy',
    'status',
    'is_degree',
    'is_major_field_study',
    'is_grad_date',
    'is_credits_completed',
    'is_overall_gpa',
    'is_major_gpa',
    'gpa_format',
    
    ];
    public function minors()
    {
        return $this->hasMany(Minor::class);
    }
        public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }


}
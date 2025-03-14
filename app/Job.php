<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;

class Job extends Model
{
    protected $table = 'job';
    protected $fillable = [
        'id',
        'user_id',
        'is_dates',
        'is_month_year',
        'is_year',
        'is_city_state_country',
        'is_city_state',
        'is_location',
        'is_job_description',
        'position_id',
        'title_id',
        'company',
        'position',
        'city',
        'state',
        'country',
        'start_month',
        'start_year',
        'end_month',
        'end_year',
        'created_at',
        'updated_at',
    ];

    public function position()
    {

        return $this->belongsTo(Position::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country');
    }
    public function stateRelation()
    {
        return $this->belongsTo(State::class,'state');
    }

     public function getStateAttribute()
    {
           if ($this->relationLoaded('state') && $this->getRelation('state')) {
            return $this->getRelation('state')->state; // Adjust 'state' to the actual column name in the State model
        }

        // Return the state column from the job table
       return $this->attributes['state'] ?? null;
    }

    public function endorsements()
    {
        return $this->hasMany(Endorsement::class,'job_id');
    }

    public function jobdescription()
    {
        return $this->hasMany(JobDescription::class,'job_id');
    }

     public function experiences()
    {
        return $this->hasMany(Experience::class,'job_id');
    }
}
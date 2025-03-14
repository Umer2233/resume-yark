<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionQuestion extends Model
{
    protected $table = 'position_question';
    protected $fillable = [
        'position_id',
        'question_id',
        'importance_rating',
        'user_rating',
        'is_active',
    ];
    
    public function Resume()
    {
        return $this->hasMany('App\Resume', 'position_id', 'position_id');
    }
    public function Job()
    {
        return $this->hasMany('App\Job', 'position_id', 'position_id');
    }
}

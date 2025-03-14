<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionSkill extends Model
{
    protected $table = 'position_skill';
    protected $fillable = ['position_id', 'skill_id', 'hot', 'user_rating', 'is_active'];
}

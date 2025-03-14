<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $guarded = [];

    public function fonts()
    {
        return $this->belongsToMany(Font::class,'templates_fonts');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class,'templates_colors');
    }
}
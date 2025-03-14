<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $guarded = [];

     public function templates()
    {
        return $this->belongsToMany(Template::class,'templates_colors');
    }
}
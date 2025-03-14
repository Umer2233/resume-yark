<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Font extends Model
{
    use HasFactory;
    
    public function templates()
    {
        return $this->belongsToMany(Template::class,'templates_fonts');
    }
}
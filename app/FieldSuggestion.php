<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldSuggestion extends Model
{
    protected $fillable = ['field', 'suggestion', 'active'];
}

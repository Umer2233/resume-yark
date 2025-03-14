<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';
    protected $fillable = [
        'pos_name', 'pos_description', 'soc_code', 'major_gid', 'minor_gid', 'url_desc', 'is_active', 'def_title_id'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}

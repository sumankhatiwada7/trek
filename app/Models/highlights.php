<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class highlights extends Model
{
    protected $fillable = [
        'trek_id',
        'day',
        'description'
    ];
    public function highlight()
    {
        return $this->belongsTo(trek::class,'trek_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class trek_images extends Model
{
    protected $fillable = [
        'trek_id',
        'photo',
    ];
    public function image(){
        return $this->belongsTo(trek::class,'trek_id');
    }
}

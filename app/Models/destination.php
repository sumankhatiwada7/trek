<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\trek;

class destination extends Model
{
protected $fillable = [
    'destination_name',
    'region',
    'description',
    'elevation',
    'best_season',
    'treks_available',
    'tagline',
    'path',
    'latitude',
    'longitude',
];
public function treks(){
    return $this->hasMany(trek::class,'destination_id');
}
}

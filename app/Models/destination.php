<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class trek extends Model
{
    protected $fillable = [
        'trekname',
        'region',
        'difficultylevel',
        'duration',
        'latitude',
        'longitude',
        'description',
        'image_url',
        'map_route',
    ];
}

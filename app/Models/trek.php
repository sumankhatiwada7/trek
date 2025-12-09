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
        'elevation',
        'season',
        'description',
        'group_size',
        'map_route',
    ];
    public function trekImages(){
        return $this->hasMany(trek_images::class,'trek_id');

    }
    public function highlights(){
        return $this->hasMany(highlights::class,'trek_id');
    }
    public function itinerary(){
        return $this->hasMany(itinerary::class,'trek_id');
    }
}

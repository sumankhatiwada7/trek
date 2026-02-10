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
        'latitude',
        'longitude',
        'price',
        'tagline',
        'destination_id',
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
    public function bookings(){
        return $this->hasMany(booking::class,'trek_id');
    }
    public function destination(){
        return $this->belongsTo(destination::class,'destination_id');
    }
}

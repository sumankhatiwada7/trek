<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class itinerary extends Model
{
    protected $table = 'itinerary';
    protected $fillable = [
        'trek_id',
        'day',
        'title',
        'description'
    ];
    public function trek()
    {
        return $this->belongsTo(trek::class,'trek_id');
    }
}

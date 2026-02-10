<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    
    protected $fillable = [
        'name',
        'booking_date',
        'email',
        'phone',
        'trek_id',
        'number_of_people',
        'additional_infromation',
        'status'
    ];

    public function trek()
    {
        return $this->belongsTo(trek::class, 'trek_id');
    }
}

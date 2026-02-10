<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_uuid',
        'gateway',
        'amount',
        'status',
        'booking_id',
        'reference_id',
        'response'
    ];

    protected $casts = [
        'response' => 'array',
    ];
}


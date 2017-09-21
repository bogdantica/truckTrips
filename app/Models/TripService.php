<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripService extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'trip_id'
    ];

    public $timestamps = false;
}

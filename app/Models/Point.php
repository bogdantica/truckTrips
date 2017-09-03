<?php

namespace App\Models;


class Point extends BaseModel
{

    protected $table = 'trips_points';

    protected $fillable = [
        'point_type_id',
        'place_id',
        'description',
        'current_kilometers',
        'arrived_at',
        'departed_at',
        'latitude',
        'longitude',
    ];

    protected $dates = [
        'arrived_at',
        'departed_at'
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}

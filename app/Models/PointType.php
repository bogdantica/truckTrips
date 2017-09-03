<?php

namespace App\Models;


class PointType extends BaseModel
{

    protected $table = 'trips_points_types';

    const START = 10;
    const INTERMEDIATE = 20;
    const END = 30;

    protected $fillable = [
        'name',
        'display',
        'point_type_id',
        'description',
    ];

}

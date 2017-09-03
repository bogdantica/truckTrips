<?php

namespace App\Models;


class EventType extends BaseModel
{
    protected $table = 'events_types';

    const TRIP = 10;
    const FUEL = 20;

    protected $fillable = [
        'name',
        'display',
        'event_type_id',
        'description',
    ];

}

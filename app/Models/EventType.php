<?php

namespace App\Models;


/**
 * App\Models\EventType
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $display
 * @property int $event_type_id
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereEventTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereUpdatedAt($value)
 */
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

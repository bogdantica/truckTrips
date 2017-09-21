<?php

namespace App\Models;


/**
 * App\Models\Point
 *
 * @property-read \App\Models\Place $place
 * @mixin \Eloquent
 * @property int $id
 * @property int $trip_id
 * @property int $point_type_id
 * @property int|null $place_id
 * @property string|null $description
 * @property float|null $current_kilometers
 * @property \Carbon\Carbon|null $arrived_at
 * @property \Carbon\Carbon|null $departed_at
 * @property float|null $latitude
 * @property float|null $longitude
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereArrivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereCurrentKilometers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereDepartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point wherePointTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereUpdatedAt($value)
 */
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Point
 *
 * @package App\Models
 * @property int $id
 * @property int $trip_id
 * @property int $point_type_id
 * @property int|null $place_id
 * @property int|null $cargo_type_id
 * @property float|null $cargo_weight
 * @property float|null $cargo_volume
 * @property string|null $details
 * @property string|null $schedule_date
 * @property string|null $schedule_time
 * @property string|null $confirmed_date
 * @property string|null $confirmed_time
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Place|null $place
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereCargoTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereCargoVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereCargoWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereConfirmedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereConfirmedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point wherePointTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereScheduleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereScheduleTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Point whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Point extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'trips_points';

    /**
     * @var array
     */
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

    /**
     * @var array
     */
    protected $dates = [
        'arrived_at',
        'departed_at',
        'schedule_time',
        'schedule_date'
    ];

    /**
     * @return BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}

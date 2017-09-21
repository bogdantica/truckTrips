<?php

namespace App\Models;


/**
 * App\Models\PointType
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $display
 * @property int $point_type_id
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType wherePointTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointType whereUpdatedAt($value)
 */
class PointType extends BaseModel
{

    protected $table = 'trips_points_types';

    const START = 10;
    const LOAD = 20;
    const UNLOAD = 30;
    const END = 40;

    protected $fillable = [
        'name',
        'display',
        'point_type_id',
        'description',
    ];

}

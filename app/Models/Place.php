<?php

namespace App\Models;


use App\Truck\GooglePlace;

/**
 * App\Models\Place
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $region
 * @property string|null $google_place_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereGooglePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Place whereUpdatedAt($value)
 */
class Place extends BaseModel
{
    protected $fillable = [
        'name',
        'region',
        'google_place_id',
        'latitude',
        'longitude',
    ];

    /**
     * @param $id
     * @return $this
     */
    public static function parseRequest($id)
    {
        if (is_numeric($id)) {
            return static::find($id, ['id']);
        }

        if (strlen($id) == 27) {

            $exists = static::where('google_place_id', $id)->first();
            if ($exists) {
                return $exists;
            }

            $googlePlace = (new GooglePlace())->detail($id);

            if ($googlePlace) {
                return static::create([
                    'name' => $googlePlace->name,
                    'google_place_id' => $googlePlace->google_id,
                    'latitude' => $googlePlace->latitude,
                    'longitude' => $googlePlace->longitude,
                    'region' => $googlePlace->region ?? null
                ]);
            }
        }

        if (strpos($id, 'custom_place_') !== false) {
            $place = str_replace('custom_place_', '', $id);
            return static::create([
                'name' => $place,
            ]);
        }

        return null;
    }

}

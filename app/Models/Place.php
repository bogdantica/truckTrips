<?php

namespace App\Models;


use App\Truck\GooglePlace;

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
    protected function parseRequest($id)
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

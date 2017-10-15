<?php

namespace App\Models;



class Vehicle extends BaseModel
{
    protected $fillable = [
        'name',
        'registration',
        'external_id',
        'vin',
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

        $id = str_replace('-', '', str_replace(' ', '', strtoupper($id)));
        $byName = static::where('registration', $id)->first();

        if ($byName) {
            return $byName;
        }

        return static::create([
            'registration' => $id
        ]);

    }

    public function type()
    {
        return $this->belongsTo(VehicleType::class,'vehicle_type_id');
    }

}

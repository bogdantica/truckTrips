<?php

namespace App\Models;

/**
 * Class Company
 * @package App\Models
 */
class Company extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'cif',
        'reg_id',
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

        $id = strtolower($id);

        $byName = static::where('name', ucwords($id))->first();

        if ($byName) {
            return $byName;
        }

        return static::create([
            'name' => ucwords($id)
        ]);

    }

}

<?php

namespace App\Models;

/**
 * App\Models\Vat
 *
 * @property int $id
 * @property string $name
 * @property float $percentage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Vat wherePercentage($value)
 * @mixin \Eloquent
 */
class Vat extends BaseModel
{
    protected $fillable = [
        'name',
        'percentage',
    ];

    public $timestamps = false;
}

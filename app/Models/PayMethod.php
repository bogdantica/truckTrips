<?php

namespace App\Models;

/**
 * App\Models\PayMethod
 *
 * @property int $id
 * @property string $name
 * @property string $details
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayMethod whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayMethod whereName($value)
 * @mixin \Eloquent
 */
class PayMethod extends BaseModel
{
    protected $fillable = [
        'name',
        'details',
    ];

    public $timestamps = false;
    
}

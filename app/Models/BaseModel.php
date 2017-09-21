<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 03/09/2017
 * Time: 10:00
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\BaseModel
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel withoutTrashed()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
//    use SoftDeletes;
}
<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 03/09/2017
 * Time: 10:00
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;
}
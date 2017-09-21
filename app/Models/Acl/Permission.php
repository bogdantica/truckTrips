<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 19/09/2017
 * Time: 20:29
 */

namespace App\Modes\Acl;


use Zizaco\Entrust\EntrustPermission;

/**
 * App\Modes\Acl\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modes\Acl\Role[] $roles
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Permission whereUpdatedAt($value)
 */
class Permission extends EntrustPermission
{

}
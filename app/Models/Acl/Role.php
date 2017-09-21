<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 19/09/2017
 * Time: 20:29
 */

namespace App\Modes\Acl;


use Zizaco\Entrust\EntrustRole;

/**
 * App\Modes\Acl\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modes\Acl\Permission[] $perms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modes\Acl\Role whereUpdatedAt($value)
 */
class Role extends EntrustRole
{

}
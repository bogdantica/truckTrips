<?php

namespace App\Models;

/**
 * Class Company
 *
 * @package App\Models
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $cif
 * @property string|null $reg_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereRegId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @property string|null $address
 * @property int|null $place_id
 * @property string|null $fax_number
 * @property string|null $phone_number
 * @property string|null $email
 * @property string|null $website
 * @property int|null $contact_user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereContactUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereFaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereWebsite($value)
 */
use App\Sessions\Customer\Customer;

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
        'address',
        'place_id',
        'fax_number',
        'phone_number',
        'email',
        'website',
        'contact_user_id',
        'owner_user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function drivers()
    {
        return $this->belongsToMany(User::class,'company_drivers');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class,'company_vehicles');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function owners()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany(Trip::class, 'sender_company_id');
    }

    /**
     * @param $id
     * @return $this
     */
    public static function parseRequest($id)
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


    protected function byCurrentCustomer()
    {
        $customer = (new Customer());
        return $this->find($customer->get('company'));
    }
}

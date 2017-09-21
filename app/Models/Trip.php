<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'sender_company_id',
        'receiver_company_id',
        'driver_user_id',
        'distance',
        'total_price',
        'vat_id',
        'details',
        'pay_method_id',
        'pay_days',
        'pay_details',
        'agreement',
        'agreement_date'
    ];

    protected $dates = [
        'agreement_date'
    ];

    /**
     * @return mixed
     */
    public function startPoint()
    {
        return $this->hasOne(Point::class)
            ->where('point_type_id', PointType::START)
            ->orderBy('created_at');
    }

    /**
     * @return HasOne
     */
    public function endPoint()
    {
        return $this->hasOne(Point::class)
            ->where('point_type_id', PointType::END)
            ->orderBy('created_at');
    }

    public function points()
    {
        return $this->hasMany(Point::class)
            ->whereIn('point_type_id', [PointType::LOAD, PointType::UNLOAD])
            ->orderBy('created_at');
    }

    public function services()
    {
        return $this->hasMany(TripService::class, 'trip_id');
    }

    public function driver()
    {
        return $this->hasOne(User::class, 'id', 'driver_user_id');
    }

    public function payMethod()
    {

        return $this->belongsTo(PayMethod::class);
    }

    /**
     * @return mixed
     */
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    /**
     * @return mixed
     */
    public function sender()
    {
        return $this->belongsTo(Company::class, 'sender_company_id');
    }

    /**
     * @return mixed
     */
    public function receiver()
    {
        return $this->belongsTo(Company::class, 'receiver_company_id');
    }


}

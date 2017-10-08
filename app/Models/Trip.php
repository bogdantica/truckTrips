<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Trip
 * @package App\Models
 */
class Trip extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = [
        'transporter_company_id',
        'beneficiary_company_id',
        'driver_user_id',
        'distance',
        'total_price',
        'vat_id',
        'details',
        'pay_method_id',
        'pay_days',
        'pay_details',
        'agreement',
        'agreement_date',
        'pay_method_id',
        'pay_date',
        'pay_details'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'agreement_date',
        'pay_date'
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

    /**
     * @return HasMany
     */
    public function points()
    {
        return $this->hasMany(Point::class)
            ->whereIn('point_type_id', [PointType::INTER])
            ->orderBy('created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(TripService::class, 'trip_id');
    }

    /**
     * @return HasOne
     */
    public function driver()
    {
        return $this->hasOne(User::class, 'id', 'driver_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payMethod()
    {

        return $this->belongsTo(PayMethod::class);
    }

    /**
     * @return mixed
     */
    public function vehicles()
    {
//        return $this->belongsToMany(Vehicle::class, '');
    }

    /**
     * @return mixed
     */
    public function transporter()
    {
        return $this->belongsTo(Company::class, 'transporter_company_id');
    }

    /**
     * @return mixed
     */
    public function beneficiary()
    {
        return $this->belongsTo(Company::class, 'beneficiary_company_id');
    }


    public function scopeFull($query)
    {
        return $query->with([
            'beneficiary',
            'transporter',
            'startPoint',
            'endPoint',
            'points',
            'driver',
            'services',
            'payMethod',
        ]);
    }

    public function scopeFullLoad($query)
    {
        $this->load([
            'beneficiary',
            'transporter',
            'startPoint',
            'endPoint',
            'points',
            'driver',
            'services',
            'payMethod',
        ]);

        return $query;
    }

}

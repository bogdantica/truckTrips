<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 08/10/2017
 * Time: 13:28
 */

namespace App\Sessions\Customer;


use App\Sessions\AbstractSession;

class Customer extends AbstractSession
{
    const SESSION_NAME = 'customer';

    protected $attributes = [
        'company' => null
    ];

    function __construct()
    {
        parent::__construct();

        if (empty($this->attributes['company'])) {
            $this->attributes['company'] = \Auth::user()->getCompany();
            $this->updateSessionData();
        }
    }

}
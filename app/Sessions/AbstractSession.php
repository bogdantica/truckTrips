<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 08/10/2017
 * Time: 13:20
 */

namespace App\Sessions;


use Illuminate\Support\Collection;

class AbstractSession
{
    const SESSION_NAME = 'abstract';

    protected $attributes = [];

    function __construct()
    {
        $this->attributes = collect($this->attributes);
        $this->getSessionData();
    }

    protected function getSessionData()
    {
        $sessionData = \Session::get(static::SESSION_NAME . '_session');
        
        if (!$sessionData) {
            $this->updateSessionData();
        }

        return $sessionData;
    }

    protected function updateSessionData()
    {
        \Session::put(static::SESSION_NAME . '_session', $this->attributes);
        return $this;
    }

    public function get($attribute)
    {
        return $this->attributes[$attribute] ?? null;
    }

    public function set(Collection $attributes)
    {
        $this->attributes->each(function ($item, $key) use ($attributes) {
            if (isset($attributes[$key])) {
                $this->attributes[$key] = $item;
            }
        });
    }
}
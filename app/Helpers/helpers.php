<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 08/10/2017
 * Time: 20:50
 */

/**
 * @param null|\Carbon\Carbon $value
 * @param string $format
 * @param null $fallBack
 * @return string|null
 */
function format($value = null, $format = 'Y-m-d H:i:s', $fallBack = null)
{
    return is_a($value, \Carbon\Carbon::class) ? $value->format($format) : $fallBack;
}

function menuItemActive($item)
{
    if (isset($item['items']) && count($item['items'])) {
        foreach ($item['items'] as $item) {
            $active = menuItemActive($item);
            if ($active) {
                return $active;
            }
        }
    } else {
        if (isset($item['route'])) {
            $active = $item['route'] == \Request::route()->getName();
            return $active;
        } elseif (isset($item['href'])) {
            $active = strpos(\Request::url(), $item['href']) !== false;
            return $active;
        }
    }
    return false;
}
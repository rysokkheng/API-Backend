<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/5/20
 * Time: 22:05
 */

namespace App\Helpers;


use App\Enums\DateFormatEnum;
use Illuminate\Support\Facades\App;

class Helpers
{
    public static function lang()
    {
        return App::getLocale();
    }

    public static function selected($v1, $v2)
    {
        return $v1 == $v2 ? 'selected' : '';
    }

    public static function numberFormat($value, $decimal = null)
    {
        if (empty($value) && $value != 0) {
            return '';
        }

        if ($decimal > 0) {
            return number_format($value, $decimal);
        }

        return number_format($value, fmod($value, 1) == 0 ? 0 : 2);
    }

    public static function isDateValid($date)
    {
        if(!is_null($date) && $date != '') {
            return strtotime($date) < 0 || strtotime($date) == false ? false : true;
        }
        else return false;
    }
}
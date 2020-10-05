<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DateFormatEnum extends Enum
{
    const Ymd   = 'Y-m-d';
    const YmdHi = 'Y-m-d H:i';
    const dMY   = 'd-M-Y';
    const dMYHi = 'd-M-Y H:i';
    const YmdHis= 'Y-m-d H:i:s';
}

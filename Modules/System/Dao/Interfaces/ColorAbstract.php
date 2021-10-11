<?php

namespace Modules\System\Dao\Interfaces;

abstract class ColorAbstract
{
    private static $colors = [
        '0' => '#fff',
        '1' => '#fff'
    ];

    private static $backgrounds = [
        '0' => '#000000',
        '1' => '#000864'
    ];

    public static function getColor($value)
    {
        return [self::$colors[$value] => self::$backgrounds[$value]];
    }
}

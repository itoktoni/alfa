<?php

namespace Modules\System\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class ShowStatus extends Enum
{
    use StatusTrait;

    const Show    = 1;
    const Hide   = 0;

    public static function colors()
    {
        return [
            self::Show => ColorType::Success,
            self::Hide => ColorType::Grey,
        ];
    }

    public static function name()
    {
        return 'Show';
    }
}

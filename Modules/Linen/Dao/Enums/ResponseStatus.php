<?php

namespace Modules\Linen\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class ResponseStatus extends Enum
{
    use StatusTrait;

    const Response   =   null;
    const Failed     =   0;
    const Create     =   1;
    const Exists     =   2;

    public static function colors()
    {
        return [
            self::Failed => ColorType::Primary,
            self::Response => ColorType::Primary,
            self::Create => ColorType::Pink,
            self::Exists => ColorType::Brown,
        ];
    }

    public static function name()
    {
        return 'Status Product';
    }
}

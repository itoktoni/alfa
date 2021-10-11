<?php

namespace Modules\System\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\BackgroundColor;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class ActiveStatus extends Enum
{
    use StatusTrait;

    const Active        = 1;
    const Inactive      = 0;

    public static function colors()
    {
        return [
            self::Active => ColorType::Info,
            self::Inactive => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Active';
    }
}

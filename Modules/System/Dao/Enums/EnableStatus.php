<?php

namespace Modules\System\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class EnableStatus extends Enum
{
    use StatusTrait;

    const Enable    = 1;
    const Disable   = 0;

    public static function colors()
    {
        return [
            self::Enable => ColorType::Primary,
            self::Disable => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Status';
    }
}

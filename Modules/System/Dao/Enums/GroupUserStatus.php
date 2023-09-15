<?php

namespace Modules\System\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class GroupUserStatus extends Enum
{
    use StatusTrait;

    const Developer    = 'developer';
    const Admin         = 'admin';
    const Administrator         = 'administrator';
    const Owner         = 'owner';

    public static function colors()
    {
        return [
            self::Developer => ColorType::Primary,
            self::Admin => ColorType::Danger,
            self::Owner => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Status';
    }
}

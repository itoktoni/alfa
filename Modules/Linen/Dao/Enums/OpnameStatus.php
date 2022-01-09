<?php

namespace Modules\Linen\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class OpnameStatus extends Enum
{
    use StatusTrait;

    const Proses            =   1;
    const Selesai           =   2;
    const Cancel            =   3;

    public static function colors()
    {
        return [
            self::Proses => ColorType::Primary,
            self::Selesai => ColorType::Primary,
            self::Cancel => ColorType::Pink,
        ];
    }

    public static function name()
    {
        return 'Status Opname';
    }
}

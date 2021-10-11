<?php

namespace Modules\Linen\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class TransactionStatus extends Enum
{
    use StatusTrait;

    const Register      =   1;
    const Kotor         =   20;
    const Gate          =   30;
    const Grouping      =   40;
    const Bersih        =   50;
    const Pending       =   60;
    const Hilang        =   70;
    const Retur         =   80;
    const Rewash        =   90;

    public static function colors()
    {
        return [
            self::Register => ColorType::Primary,
            self::Kotor => ColorType::Danger,
            self::Gate => ColorType::Danger,
            self::Grouping => ColorType::Danger,
            self::Pending => ColorType::Danger,
            self::Bersih => ColorType::Danger,
            self::Hilang => ColorType::Danger,
            self::Retur => ColorType::Danger,
            self::Rewash => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Status Product';
    }
}

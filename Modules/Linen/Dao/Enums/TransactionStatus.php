<?php

namespace Modules\Linen\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class TransactionStatus extends Enum
{
    use StatusTrait;

    const Transaction   =   null;
    const Register      =   1;
    const Kotor         =   2;
    const Gate          =   3;
    const Grouping      =   4;
    const Bersih        =   5;
    const Pending       =   6;
    const Hilang        =   7;
    const Retur         =   8;
    const Rewash        =   9;

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

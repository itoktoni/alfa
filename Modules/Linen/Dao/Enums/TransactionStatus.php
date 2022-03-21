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
            self::Kotor => ColorType::Pink,
            self::Gate => ColorType::Brown,
            self::Grouping => ColorType::Success,
            self::Bersih => ColorType::Grey,
            self::Pending => ColorType::Warning,
            self::Hilang => ColorType::Danger,
            self::Retur => ColorType::Tosca,
            self::Rewash => ColorType::Violet,
        ];
    }

    public static function name()
    {
        return 'Status Product';
    }

    public static function getDescription($value): string
    {
        if ($value === self::Transaction) {
            return '- Pilih Status - ';
        }

        if ($value === self::Grouping) {
            return 'Delivery';
        }

        return parent::getDescription($value);
    }
}

<?php

namespace Modules\Linen\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class LinenStatus extends Enum
{
    use StatusTrait;

    const Register          =  1;
    const GantiChip         =  2;
    const GantiProduct      =  3;
    const GantiRuangan      =  4;
    const GantiRs           =  5;

    const Rental            =  6;
    const Cuci              =  7;
    
    const Kotor             = 20;
    const Sesuai            = 21;
    const BedaRuangan       = 22;
    const BedaRs            = 23;
    
    const Gate              = 30;
    const BelumDiScan       = 31;

    const Grouping          = 40;
    const Bersih            = 50;

    const Pending           = 60;
    const Hilang            = 70;
    
    const Retur             = 80;
    const ChipRusak         = 81;
    const LinenRusak        = 82;
    const KelebihanStock    = 83;

    const Rewash            = 90;
    const Bernoda           = 91;
    const BahanUsang        = 92;

    public static function colors()
    {
        return [
            self::Register => ColorType::Primary,
            self::GantiChip => ColorType::Primary,
            self::GantiProduct => ColorType::Primary,
            self::GantiRuangan => ColorType::Primary,
            self::GantiRs => ColorType::Primary,
            self::Rental => ColorType::Primary,
            self::Cuci => ColorType::Primary,
            self::Kotor => ColorType::Primary,
            self::Sesuai => ColorType::Primary,
            self::BedaRuangan => ColorType::Primary,
            self::BedaRs => ColorType::Primary,
            self::Gate => ColorType::Primary,
            self::BelumDiScan => ColorType::Primary,
            self::Grouping => ColorType::Primary,
            self::Bersih => ColorType::Primary,
            self::Pending => ColorType::Primary,
            self::Hilang => ColorType::Primary,
            self::Retur => ColorType::Primary,
            self::ChipRusak => ColorType::Primary,
            self::LinenRusak => ColorType::Primary,
            self::KelebihanStock => ColorType::Primary,
            self::Rewash => ColorType::Primary,
            self::Bernoda => ColorType::Primary,
            self::BahanUsang => ColorType::Primary,
        ];
    }

    public static function name()
    {
        return 'Linen Status';
    }

    public static function getDescription($value): string
    {
        if ($value === self::BedaRs) {
            return 'Beda RS';
        }

        return parent::getDescription($value);
    }
}
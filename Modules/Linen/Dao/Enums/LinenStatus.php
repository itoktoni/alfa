<?php

namespace Modules\Linen\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class LinenStatus extends Enum
{
    use StatusTrait;

    const StatusLinen       =  null;
    // const Register     
    const Register          =  1;
    const GantiChip         =  2;
    const Rental            =  3;
    const Cuci              =  4;
    const GantiProduct      =  5;
    const GantiRuangan      =  6;
    const GantiRs           =  7;
    // const Kotor        
    const LinenKotor        =  8;
    const BedaRs            =  9;    
    const BelumDiScan       = 10;    
    // const Retur     
    const ChipRusak         = 11;
    const LinenRusak        = 12;
    const KelebihanStock    = 13;
    // const Rewash      
    const Bernoda           = 14;
    const BahanUsang        = 15;
    // const Pending Hilang      
    const Grouping          = 16;
    const Bersih            = 17;
    const Pending           = 18;
    const Hilang            = 19;
    const Retur             = 20;
    const Rewash            = 21;

    public static function colors()
    {
        return [
            self::Register => ColorType::Primary,
            self::GantiChip => ColorType::Primary,
            self::Rental => ColorType::Primary,
            self::Cuci => ColorType::Primary,
            self::GantiProduct => ColorType::Primary,
            self::GantiRuangan => ColorType::Primary,
            self::GantiRs => ColorType::Primary,
            self::LinenKotor => ColorType::Primary,
            self::BedaRs => ColorType::Primary,
            self::ChipRusak => ColorType::Primary,
            self::LinenRusak => ColorType::Primary,
            self::KelebihanStock => ColorType::Primary,
            self::Bernoda => ColorType::Primary,
            self::BahanUsang => ColorType::Primary,
            self::Grouping => ColorType::Primary,
            self::Bersih => ColorType::Primary,
            self::Pending => ColorType::Primary,
            self::Hilang => ColorType::Primary,
            self::Retur => ColorType::Primary,
            self::Rewash => ColorType::Primary,
        ];
    }

    public static function name()
    {
        return 'Linen Status';
    }
}
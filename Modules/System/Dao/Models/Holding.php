<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;

class Holding extends Model
{
    protected $table = 'system_holding';
    protected $primaryKey = 'holding_id';

    protected $fillable = [
        'holding_id',
        'holding_name',
        'holding_description',
        'holding_address',
        'holding_email',
        'holding_phone',
        'holding_person',
        'holding_logo',
        'holding_sign',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'holding_name' => 'required|min:3',
    ];

    const CREATED_AT = 'holding_created_at';
    const UPDATED_AT = 'holding_created_by';

    public $searching = 'holding_name';
    public $datatable = [
        'holding_id' => [false => 'Code'],
        'holding_name' => [true => 'Holding Name'],
        'holding_person' => [true => 'Contact Person'],
        'holding_email' => [true => 'Email'],
        'holding_phone' => [true => 'Phone'],
    ];
    
    public $show    = [
        '1' => ['Show', 'info'],
        '0' => ['Hide', 'warning'],
    ];
}


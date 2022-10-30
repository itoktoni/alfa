<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'item_unit';
    protected $primaryKey = 'item_unit_code';
    protected $keyType = 'string';

    protected $fillable = [
        'item_unit_code',
        'item_unit_name',
        'item_unit_description',
        'item_unit_created_at',
        'item_unit_created_by',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'item_unit_code' => 'required',
        'item_unit_name' => 'required',
    ];

    const CREATED_AT = 'item_unit_created_at';
    const UPDATED_AT = 'item_unit_updated_at';

    public $searching = 'item_unit_name';
    public $datatable = [
        'item_unit_code' => [true => 'Code', 'width' => 50],
        'item_unit_name' => [true => 'Name','width' => 150],
        'item_unit_description' => [true => 'Description'],
    ];

    public $status    = [
        '1' => ['Enable', 'info'],
        '0' => ['Disable', 'default'],
    ];
}

<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Category extends Model
{
    use SoftDeletes, Userstamps;
    protected $table = 'item_category';
    protected $primaryKey = 'item_category_id';

    protected $fillable = [
        'item_category_id',
        'item_category_name',
        'item_category_slug',
        'item_category_description',
        'item_category_created_at',
        'item_category_created_by',
        'item_category_image',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'item_category_name' => 'required|min:3',
    ];

    const CREATED_AT = 'item_category_created_at';
    const UPDATED_AT = 'item_category_updated_at';
    const DELETED_AT = 'item_category_deleted_at';
    const CREATED_BY = 'item_category_created_by';
    const UPDATED_BY = 'item_category_updated_by';
    const DELETED_BY = 'item_category_deleted_by';

    public $searching = 'item_category_name';
    public $datatable = [
        'item_category_id' => [false => 'Code', 'width' => 50],
        'item_category_name' => [true => 'Name'],
        'item_category_description' => [true => 'Description'],
    ];
}

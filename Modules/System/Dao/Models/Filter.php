<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
	protected $table = 'system_filter';
	protected $primaryKey = 'key';
	protected $fillable = [
		'key',
		'name',
		'module',
		'table',
		'custom',
		'field',
		'function',
		'operator',
		'value',
	];
	public $incrementing = true;
	public $timestamps = false;
}

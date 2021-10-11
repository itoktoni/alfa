<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    protected $table      = 'users'; //nama table
    protected $primaryKey = 'id'; //nama primary key
    protected $fillable    = [
        'id',
        'name',
        'email',
        'password',
        'username',
        'photo',
        'group_user',
        'remember_token',
        'address',
        'site',
        'birth',
        'place_birth',
        'notes',
        'phone',
        'deleted_at',
        'created_at',
        'updated_at',
        'active',
        'api_token',
        'token',
        'email_verified_at',
        'area',
    ];

    protected $guarded = [];

    public $rules = [
        'username'  => 'required|min:3|unique:users',
        'email'      => 'required|email|unique:users',
        'group_user' => 'required',
    ];

    public $timestamps    = true; //timestamp will true
    public $incrementing  = true; //make creating id use lastcode

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $searching     = 'name'; //searching default
    public $status = [
        '1' => ['Active', 'primary'],
        '0' => ['Pasive', 'danger'],
    ];

    public $datatable = [
        'id'            => [false => 'ID User'],
        'username'      => [true => 'Username'],
        'name'          => [true => 'Name'],
        'email'         => [false => 'Email'],
        'group_user'    => [true => 'Group User'],
        'active'        => [true => 'Active', 'width' => '100', 'class' => 'text-center'],
    ];

    public function scopeById($query, $id)
    {
        return $query->where($this->primaryKey, $id);
    }  

}

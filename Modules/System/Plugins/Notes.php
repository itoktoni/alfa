<?php

namespace Modules\System\Plugins;

class Notes
{
    const create = 'Create';
    const update = 'Update';
    const delete = 'Delete';
    const error = 'Error';
    const data = 'List';
    const single = 'Data';
    const token = 'Token';

    public static function data($data = null)
    {
        $log['status'] = true;
        $log['code'] = 200;
        $log['name'] = self::data;
        $log['message'] = 'Data berhasil diambil';
        $log['data'] = $data;
        return $log;
    }

    public static function single($data = null)
    {
        $log['status'] = true;
        $log['code'] = 200;
        $log['name'] = self::single;
        $log['message'] = 'Data di dapat';
        $log['data'] = $data;
        return $log;
    }

    public static function create($data = null)
    {
        $log['status'] = true;
        $log['code'] = 201;
        $log['name'] = self::create;
        $log['message'] = 'Data berhasil di buat';
        $log['data'] = $data;
        return $log;
    }

    public static function token($data = null)
    {
        $log['status'] = true;
        $log['code'] = 200;
        $log['name'] = self::token;
        $log['message'] = 'Data token '.self::token;
        $log['data'] = $data;
        return $log;
    }

    public static function update($data = null)
    {
        $log['status'] = true;
        $log['code'] = 200;
        $log['name'] = self::update;
        $log['message'] = 'Data berhasil di ubah';
        $log['data'] = $data;
        // if(request()->wantsJson()){
        //     $log['data'] = is_array($data) ? $data : $data->toArray();
        // }
        return $log;
    }
    
    public static function delete($data = null)
    {
        $log['status'] = true;
        $log['code'] = 204;
        $log['name'] = self::delete;
        $log['message'] = 'Data berhasil di hapus';
        $log['data'] = $data;
        return $log;
    }
    
    public static function error($data = null, $message = null)
    {
        $log['status'] = false;
        $log['code'] = 400;
        $log['name'] = self::error;
        $log['message'] = $message ?? 'Data '.self::error;
        $log['data'] = $data;
        return $log;
    }
}

<?php

namespace Modules\System\Plugins;

use Illuminate\Support\Str;

class Views
{
    public static function create($page = 'master', $folder = 'system')
    {
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.create';
    }

    public static function update($page = 'master', $folder = 'system')
    {
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.update';
    }

    public static function index($page = 'master', $folder = 'system')
    {
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.data';
    }

    public static function show($page = 'master', $folder = 'system')
    {
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.show';
    }

    public static function backend($file = false)
    {
        $path = 'System::backend.' . config('website.backend') . '.';
        return $file ? $path . $file : $path . 'layout';
    }

    public static function include ($page, $folder = false)
    {
        $folder = $folder ? $folder : config('folder');
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.form';
    }

    public static function action($page = 'master', $folder = 'system')
    {
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.actions';
    }

    public static function checkbox($page = 'master', $folder = 'system')
    {
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.checkbox';
    }

    public static function pdf($page = 'master', $folder = 'system', $name = 'default')
    {
        return ucfirst($folder) . '::page.' .Helper::snake($page) .'_'.$name.'.pdf';
    }

    public static function form($form, $page = 'master', $folder = 'system')
    {
        return ucfirst($folder) . '::page.' . Helper::snake($page) . '.' . Helper::snake($form);
    }

    public static function option($option, $placeholder = true, $raw = false, $cache = false)
    {
        $data = Helper::filter($option->dataRepository())->get();

        if (empty($data)) {
            return [];
        }

        if (!$raw) {
            $data = $data->pluck($option->searching, $option->getKeyName());
        }
        if ($placeholder) {
            $data = $data->prepend(__('- Select ' . Helper::getNameTable($option->getTable()) . ' -'), '');
        }

        return $data;
    }

    public static function status($data, $placeholder = false)
    {
        $status = collect($data)->map(function ($item) {
            if (is_array($item)) {
                return $item[0];
            }
            return $item;
        });
        if ($placeholder) {
            $status = $status->prepend(__('- Select Option -'),'');
        }
        return $status;
    }

    public static function createStatus($value, $option = false)
    {
        $color = 'default';
        $label = 'Unknows';

        $label = $option[$value][0] ?? $label;
        $color = $option[$value][1] ?? $color;
        return '<span class="btn btn-xs btn-block btn-' . $color . '">' . $label . '</span>';
    }
}

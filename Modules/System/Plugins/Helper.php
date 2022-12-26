<?php

namespace Modules\System\Plugins;

use ChrisKonnertz\StringCalc\StringCalc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Modules\System\Dao\Facades\FilterFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Thedevsaddam\LaravelSchema\Schema\Schema as Table;

class Helper
{
    public static $cal;
    public static function base_url()
    {
        return config('app.url');
    }
    public static function access()
    {
        $split = explode('/', Route::current()->uri);
        $access = $split[0];
        return $access;
    }
    public static function secure()
    {
        return config('website.secure');
    }

    public static function asset($path)
    {
        $public = config('website.public');
        if (config('website.asset')) {
            $public = '';
        }
        return asset($public . $path, self::secure());
    }

    public static function disableSecure($path)
    {
        $public = config('website.public');
        if (config('website.env') == 'dev') {
            $public = '';
        }
        $path = asset($public . '/backend/' . config('website.backend') . '/' . $path, false);
        return $path;
    }

    public static function frontend($path)
    {
        return self::asset('/frontend/' . config('website.frontend') . '/' . $path);
    }

    public static function backend($path)
    {
        return self::asset('/backend/' . config('website.backend') . '/' . $path);
    }

    public static function credential($path)
    {
        return self::asset('/credential/' . $path);
    }

    public static function files($path, $disable = false)
    {
        if ($disable) {
            if (!file_exists(public_path('/files/' . $path, false))) {
                return $path = asset('/vendor/default/no_image.jpg', false);
            }
            return $path = asset($path . '/files/' . $path, false);
        }

        if (!file_exists(public_path('/files/' . $path))) {
            return $path = asset('/vendor/default/no_image.jpg');
        }

        return self::asset('/files/' . $path);
    }

    public static function print($path, $disable = false)
    {
        if ($disable) {
            return $path = public_path('/files/' . $path);
        }
        return $path = public_path('/files/' . $path);
    }

    public static function vendor($path)
    {
        if (!file_exists(public_path('/vendor/' . $path))) {
            return $path = asset('/vendor/default/no_image.jpg');
        }
        return self::asset('/vendor/' . $path);
    }

    public static function unic($length)
    {
        $chars = array_merge(range('a', 'z'), range('A', 'Z'));
        $length = intval($length) > 0 ? intval($length) : 16;
        $max = count($chars) - 1;
        $str = "";

        while ($length--) {
            shuffle($chars);
            $rand = mt_rand(0, $max);
            $str .= $chars[$rand];
        }

        return $str;
    }

    public static function autoNumber($tablename, $fieldid, $prefix, $codelength)
    {
        $db = DB::table($tablename);
        $db->select(DB::raw('max(' . $fieldid . ') as maxcode'));
        $db->where($fieldid, "like", "$prefix%");

        $ambil = $db->first();
        $data = $ambil->maxcode;

        if ($db->count() > 0) {
            $code = substr($data, strlen($prefix));
            $countcode = ($code) + 1;
        } else {
            $countcode = 1;
        }
        $newcode = $prefix . str_pad($countcode, $codelength - strlen($prefix), "0", STR_PAD_LEFT);
        return $newcode;
    }

    public static function getClass($class)
    {
        return (new \ReflectionClass($class))->getShortName();
    }

    public static function getClassLower($class)
    {
        return strtolower(self::getClass($class));
    }

    public static function filterInput($value)
    {
        $number = str_replace('.', ',', str_replace(',', '', $value));
        if (empty($number)) {
            return 0;
        } elseif (is_numeric($number)) {
            return floatval($number);
        } else {
            return $value;
        }
    }

    public static function formatNumber($value)
    {
        return floatval(preg_replace("/[^0-9.]/", '', $value));
    }

    public static function label($data)
    {
        $controller = Route::current()->getController();
        $table = $controller->model->getTable();
        $datatable = $controller->model->datatable;
        $field = $controller->model->getFillable();
        // $list = [];
        // foreach ($field as $value) {

        //     $split = explode('_', $value);
        //     if (count($split) > 1) {
        //         $nama = ucwords(str_replace('_', ' ', $value));
        //     } else {
        //         $nama = ucwords($value);
        //     }

        //     $clean    = str_replace('Id', 'Code', $nama);
        //     $list[$value] = [false => $clean];
        // }

        // if (!empty($datatable)) {
        //     $field = array_merge($field, $datatable);
        // }

        if (array_key_exists($data, $datatable)) {
            return key(array_flip($datatable[$data]));
        }

        return ucwords(str_replace('_', ' ', $data));
    }

    public static function listData($datatable)
    {
        $collection = collect($datatable);
        $filtered = $collection->filter(function ($value, $key) {
            if (array_key_exists('1', $value)) {
                return $value[1];
            }
        })->mapWithKeys(function ($value, $key) {
            $data = [
                'name' => $value[1],
                'width' => $value['width'] ?? false,
                'class' => $value['class'] ?? false,
            ];
            return [$key => $data];
        });

        return $filtered;
    }

    public static function listWidth($datatable)
    {
        $collection = collect($datatable);
        $filtered = $collection->filter(function ($value, $key) {
            if (array_key_exists('1', $value)) {
                return $value[1];
            }
        })->mapWithKeys(function ($value, $key) {
            return [$key => $value['width'] ?? 0];
        });

        return $filtered;
    }

    public static function masterCheckbox($template = null)
    {
        if (!empty($template)) {
            return 'page.' . $template . '.checkbox';
        }
        return 'page.master.checkbox';
    }

    public static function masterAction($template = null)
    {
        if (!empty($template)) {
            return 'page.' . $template . '.action';
        }
        return 'page.master.action';
    }

    public static function createImage($image)
    {
        $path = self::files('logo/image.jpg');
        if (file_exists(public_path('files//' . $image))) {
            $path = self::files($image);
        }
        return '<img width="95" src="' . $path . '">';
    }

    public static function createCheckbox($id)
    {
        return '<input type="checkbox" name="id[]" value="' . $id . '">';
    }

    public static function createTotal($data, $comma = false)
    {
        return '<div align="center">' . number_format($data, $comma) . '</span>';
    }

    public static function createCenter($data)
    {
        return '<div align="center">' . $data . '</span>';
    }

    public static function calculate($string)
    {
        if (self::$cal == null) {
            self::$cal = new StringCalc();
        }
        return self::$cal->calculate($string);
    }

    public static function shareTag($model, $field, $cache = false)
    {
        $data = self::shareOption($model, false, true, $cache)->mapWithKeys(function ($item) use ($field) {
            return [$item[$field] => self::snakeToLabel($item[$field])];
        });

        return $data;
    }

    public static function shareOption($option, $placeholder = true, $raw = false, $cache = false)
    {
        if (is_object($option)) {
            $data = $option->dataRepository()->get();
            if ($cache && !Cache::has($option->getTable() . '_api')) {
                Cache::put($option->getTable() . '_api', $data, config('website.cache'));
                $data = Cache::get($option->getTable() . '_api');
            } elseif ($cache && Cache::has($option->getTable() . '_api')) {
                $data = Cache::get($option->getTable() . '_api');
            }

            if (empty($data)) {
                return [];
            }

            if (!$raw) {
                $data = $data->pluck($option->searching, $option->getKeyName());
            }
            if ($placeholder) {
                $data = $data->prepend('- Select ' . self::getNameTable($option->getTable()) . ' -', '');
            }

            return $data;
        } else {
            // $response = Curl::to(route($option))->withData([
            //     'clean' => true,
            //     'api_token' => auth()->user()->api_token,
            // ])->post();
            // $json  = json_decode($response);
            // if (isset($json->data)) {
            //     $data = collect($json->data);
            // }
        }
    }

    public static function shareStatus($data)
    {
        $status = collect($data)->map(function ($item, $key) {
            if (is_array($item)) {
                return $item[0];
            }
            return $item;
        });
        return $status;
    }

    public static function createStatus($value, $option = false)
    {
        if (is_array($option))
        {
            $color = 'default';
            $label = 'Unknows';

            $label = $option[$value][0] ?? $label;
            $color = $option[$value][1] ?? $color;
            return '<span class="btn btn-xs btn-block btn-' . $color . '">' . $label . '</span>';
        }
        else
        {
            $background = $option::colors()[$value] ?? 'lightgrey';
            return '<span style="background:' . $background . ';" class="btn btn-xs btn-block btn-primary">' . $option::getDescription($value) . '</span>';
        }
    }

    public static function snakeToLabel($value)
    {
        return ucwords(str_replace('-', ' ', $value));
    }

    public static function functionToLabel($value)
    {

        return Str::of($value)->snake('_')->replace('_', ' ')->title();
    }

    public static function createTag($data, $implode = false)
    {
        $string = '';
        if (!empty($data)) {
            $collection = collect(json_decode($data))->map(function ($value) {
                return str_replace('_', ' ', $value);
            });
            $string = $collection->implode(', ');
            if ($implode) {
                $string = $collection->implode($implode, ', ');
            }
        }
        return $string;
    }

    public static function createNumber($data, $active = true)
    {
        $status = $active ? 'success' : 'danger';
        $class = '<h6 class="text-center text-' . $status . '">' . number_format($data) . '</h6>';
        return $class;
    }

    public static function createSort($data)
    {
        $class = "form-control input-sm text-center";
        $aksi = '<input type="hidden" name="kode[]" value="' . $data['hidden'] . '">';
        $aksi = $aksi . '<input type="text" name="order[]" style="width:50px;" class="' . $class . '" value="' . $data['value'] . '">';
        return $aksi;
    }

    public static function createAction($data)
    {
        $action = '<div class="action text-center">';
        $id = $data['key'];
        $button = 0;
        foreach ($data['action'] as $key => $value) {
            $val = isset($value[1]) ? $value[1] : $key;
            $list_action = config('action') ?? [];
            $print = $val == 'print' ? 'target=__blank' : '';
            if (array_key_exists($key, config('action'))) {
                $button++;
                $route = route($data['route'] . '_' . $key, ['code' => $id]);
                $action = $action . '<a ' . $print . ' id="linkMenu" href="' . $route . '" class="btn btn-xs btn-' . $value[0] . '">' . $val . '</a> ';
            }
        }
        session()->put('button', $button);
        return $action . '</div>';
    }

    public static function getNameTable($table)
    {
        if (strpos($table, '_') !== false) {
            $explode = explode('_', $table);
            $first = $explode[0];
            $table = str_replace($first, '', $table);
        }
        return ucwords(str_replace('_', ' ', $table));
    }

    public static function createOption($option, $placeholder = true, $raw = false, $cache = false)
    {
        $data = $option->dataRepository()->get();

        if (empty($data)) {
            return [];
        }

        if (!$raw) {
            $data = $data->pluck($option->searching, $option->getKeyName());
        }
        if ($placeholder) {
            $data = $data->prepend('- Select ' . self::getNameTable($option->getTable()) . ' -', '');
        }

        return $data;
    }

    public static function getTable($table = null)
    {
        if (Cache::has('tables')) {
            $arrayTable = Cache::get('tables');
            if (empty($table)) {
                return $arrayTable;
            }
            return $arrayTable[$table];
        }

        return \Illuminate\Support\Facades\Schema::getColumnListing($table);
    }

    public static function getTranslate($table, $merge = null)
    {
        $column = self::getTable($table);
        $data = [];
        foreach ($column as $key => $value) {
            $split = explode('_', $value);
            if (count($split) > 1) {
                $nama = ucwords(str_replace('_', ' ', $value));
            } else {
                $nama = ucwords($value);
            }

            $clean_id = str_replace('Id', '', $nama);
            $clean_table = str_replace(ucwords($table), '', $clean_id);
            if (ctype_space($clean_table)) {
                $clean_table = 'Code';
            }
            $data[$value] = [false => $clean_table];
        }

        if (!empty($merge)) {
            $data = array_merge($data, $merge);
        }
        return $data;
    }

    public static function fields($data)
    {
        $fields = self::listData($data);
        return $fields->keys()->all();
    }

    public static function checkJson($id, $data)
    {
        $status = false;
        if (!empty($data)) {
            $arr = json_decode($data);
            if (is_array($data) && in_array($id, $arr)) {
                $status = true;
            } elseif ($id == $arr) {
                $status = true;
            }
        }

        return $status;
    }

    public static function extension($data)
    {
        return File::extension($data);
    }

    public static function ext($data)
    {
        $icon = self::extension($data);
        $mapping = collect(config('icon'));
        $check = $mapping->has($icon);
        return $check ? config('icon.' . $icon) : 'file';
    }

    public static function mode($data)
    {
        $icon = self::extension($data);
        $mapping = collect(config('ext'));
        $check = $mapping->has($icon);
        return $check ? config('ext.' . $icon) : 'txt';
    }

    public static function getMethod($class, $module = false)
    {
        $className = 'Modules\\' . $module . '\\Http\\Controllers\\' . ucfirst(Str::camel($class . '_controller'));
        if ($module) {
        } else {
            $className = 'App\\Http\\Controllers\\' . ucfirst(Str::camel($class . '_controller'));
        }
        $reflector = new \ReflectionClass($className);
        $methodNames = array();
        foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if (strpos($method->name, 'scope') !== false || strpos($method->name, 'Join') !== false || strpos($method->name, 'Relationship')) {
            } else {

                if (($method->class == $reflector->getName() && $method->name != '__construct')) {
                    $methodNames[] = $method->name;
                }
            }
        }

        return $methodNames;
    }

    public static function dataColumn($datatable)
    {
        return array_unique(array_keys($datatable));
    }

    public static function getDataFilter($model = null)
    {
        $table = $model->getModel()->getTable();
        if (Cache::has('filter')) {
            $filter = Cache::get('filter');
        } else {
            $filter = DB::table(FilterFacades::getTable())->get();
            Cache::put('filter', $filter, 3000);
        }

        if (!empty($filter)) {
            $data = $filter
                ->where('module', str_replace('_api', '', Route::currentRouteName()))
                ->where('table', $table)
                ->all();
            if (!empty($data)) {
                return $data;
            }
        }
        return false;
    }

    public static function filter($data)
    {
        $dataFilter = self::getDataFilter($data);
        if ($dataFilter) {
            $data->where(function ($query) use ($dataFilter) {
                foreach ($dataFilter as $filtering) {
                    switch ($filtering->custom) {
                        case 1:
                            if (is_string($filtering->value)) {

                                $value = $filtering->value;
                            } else {

                                $value = json_decode($filtering->value);
                            }
                            break;
                        case 0:
                            if (!request()->ajax() && request()->wantsJson()) {
                                $auth = TeamFacades::where('api_token', request()->bearerToken())->first();
                            } else {
                                $auth = Auth::user();
                            }
                            $value = $auth->{$filtering->value};
                            break;
                    }
                    if ($filtering->operator) {
                        $query->{$filtering->function}($filtering->field, $filtering->operator, $value);
                    } else {
                        $query->{$filtering->function}($filtering->field, $value);
                    }
                }
            });
        }
        return $data;
    }

    public static function form($template, $folder = false)
    {
        $folder = config('action')['create'] ?? false;
        if ($folder) {
            return Str::snake($folder) . '_' . $template . '.form';
        }

        return 'page.' . $template . '.form';
    }

    public static function include($template, $folder = false)
    {
        $list_action = array_values(config('action'));
        $folder = $list_action ? $list_action[0] : false;
        if ($folder) {
            return ucfirst($folder) . '::page.' . $template . '.form';
        }

        return 'page.' . $template . '.form';
    }

    public static function includeForm($template, $form, $folder = false)
    {
        $list_action = array_values(config('action'));
        $folder = $list_action ? $list_action[0] : false;
        if ($folder) {
            return ucfirst($folder) . '::page.' . $template . '.' . $form;
        }

        return 'page.' . $template . '.' . $form;
    }

    public static function setExtendBackend($additional = false)
    {
        $path = 'backend.' . config('website.backend') . '.';
        return $additional ? $path . '.' . $additional : $path . 'app';
    }

    public static function setExtendPopup($additional = false)
    {
        $path = 'backend.' . config('website.backend') . '.';
        return $additional ? $path . '.' . $additional : $path . 'popup';
    }

    public static function setExtendFrontend($additional = false, $page = false)
    {
        $path = 'frontend.' . config('website.frontend') . '.';
        if ($additional && $page) {
            $path = $path . 'page.' . $additional;
        } elseif ($additional && !$page) {
            $path = $path . $additional;
        } else {
            $path = $path . 'layouts';
        }
        return $path;
    }

    public static function setViewDashboard($template = 'default')
    {
        return 'page.home.' . $template;
    }

    public static function setViewEmail($template, $module = false)
    {
        if ($module) {
            return ucfirst($module) . '::email.' . $template;
        }

        return 'email.' . $template;
    }

    public static function setViewSpa($template, $module = false)
    {
        if ($module) {
            return ucfirst($module) . '::spa.' . $template;
        }

        return 'email.' . $template;
    }

    public static function setViewPrint($template, $module = false)
    {
        if ($module) {
            return ucfirst($module) . '::print.' . $template;
        }

        return 'print.' . $template;
    }

    public static function setViewSave($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.save';
            return $view;
        }

        return 'page.' . $template . '.save';
    }

    public static function setViewForm($template = 'master', $form = null, $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.' . $form;
            return $view;
        }

        return 'page.' . $template . '.' . $form;
    }

    public static function setViewCreate($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.create';
            return $view;
        }

        return 'page.' . $template . '.create';
    }

    public static function setViewUpdate($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.update';
            return $view;
        }

        return 'page.' . $template . '.update';
    }

    public static function setViewData($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.data';
            return $view;
        }
        return 'page.' . $template . '.data';
    }

    public static function setViewPopup($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.popup';
            return $view;
        }
        return 'page.' . $template . '.popup';
    }

    public static function setViewShow($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.show';
            return $view;
        }

        return 'page.' . $template . '.show';
    }

    public static function setViewAction($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.actions';
            return $view;
        }

        return 'page.' . $template . '.actions';
    }

    public static function setViewCheckbox($template = 'master', $modular = false)
    {
        if ($modular) {
            $view = ucfirst($modular) . '::page.' . $template . '.checkbox';
            return $view;
        }

        return 'page.' . $template . '.checkbox';
    }

    public static function setViewFrontend($template = 'default')
    {
        return 'frontend.' . config('website.frontend') . '.page.' . $template;
    }

    public static function setViewLivewire($class, $folder = false)
    {

        $class = Str::snake(self::getClass($class));
        $folder = $folder ? $folder . '.' . $class : $class;
        return 'frontend.' . config('website.frontend') . '.page.' . $folder;
    }

    public static function getTemplate($class)
    {
        $controller = (new \ReflectionClass($class))->getShortName();
        $remove = Str::replaceLast('Controller', '', $controller);
        $clean = Str::replaceLast('Repository', '', $remove);
        return Str::snake($clean);
    }

    public static function uploadFile($file, $folder)
    {
        $name = false;
        if (!empty($file)) { //handle images
            $name = time() . "." . $file->getClientOriginalExtension();
            $file->storeAs($folder, $name);
            $file->storeAs($folder, 'thumbnail_' . $name);
            return $name;
        }
    }

    public static function uploadImage($file, $folder, $width = 400, $height = 150)
    {
        $name = false;
        if (!empty($file)) { //handle images
            $name = time() . "." . $file->getClientOriginalExtension();
            $file->storeAs($folder, $name);
            $file->storeAs($folder, 'thumbnail_' . $name);
            //Resize image here
            $thumbnailpath = public_path('files//' . $folder . '//' . 'thumbnail_' . $name);
            $img = Image::make($thumbnailpath)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            return $name;
        }
    }

    public static function removeImage($name, $folder)
    {
        $status = false;
        $path = public_path('files//' . $folder . '//');
        if (file_exists($path . $name)) {
            unlink($path . $name);
            unlink($path . 'thumbnail_' . $name);
            $status = true;
        }
        return $status;
    }

    public static function snake($value)
    {
        return Str::snake($value);
    }

    // public static function getSingleProvince($id, $raw = false){
    //     $data = Province::find($id);
    //     if($raw){
    //         return $data;
    //     }
    //     return $data->rajaongkir_province_name ?? '';
    // }

    // public static function getSinglecity($id, $raw = false){
    //     $data = City::find($id);
    //     if($raw){
    //         return $data;
    //     }
    //     return $data->rajaongkir_city_name ?? '';
    // }

    // public static function getSingleArea($id, $single = false, $raw = false)
    // {
    //     $array = [];
    //     $data = AreaFacades::find($id);
    //     if ($data) {
    //         if ($raw) {
    //             $location = $data->rajaongkir_area_name.' - '.$data->rajaongkir_area_type.' '.$data->rajaongkir_area_city_name.' - '.$data->rajaongkir_area_province_name;
    //             return [
    //                 'province' => [$data->rajaongkir_area_province_id => $data->rajaongkir_area_province_name],
    //                 'city' => [$data->rajaongkir_area_city_id => $data->rajaongkir_area_city_name],
    //                 'type' => [$data->rajaongkir_area_type => $data->rajaongkir_area_type],
    //                 'area' => [$data->rajaongkir_area_id => $data->rajaongkir_area_name],
    //             ];
    //         }

    //         if ($single) {
    //             $location = $data->rajaongkir_area_name.' - '.$data->rajaongkir_area_type.' '.$data->rajaongkir_area_city_name.' - '.$data->rajaongkir_area_province_name;
    //             return $data ? $location : '';
    //         }
    //         if (!empty($id)) {
    //             $location = $data->rajaongkir_area_name.' - '.$data->rajaongkir_area_type.' '.$data->rajaongkir_area_city_name.' - '.$data->rajaongkir_area_province_name;
    //             $array[$id] = $location;
    //         }
    //     }
    //     return $array;
    // }

    public static function createRupiah($value)
    {
        return number_format($value, 0, ',', '.');
    }

    public static function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } elseif ($nilai < 20) {
            $temp = self::penyebut($nilai - 10) . " belas";
        } elseif ($nilai < 100) {
            $temp = self::penyebut($nilai / 10) . " puluh" . self::penyebut($nilai % 10);
        } elseif ($nilai < 200) {
            $temp = " seratus" . self::penyebut($nilai - 100);
        } elseif ($nilai < 1000) {
            $temp = self::penyebut($nilai / 100) . " ratus" . self::penyebut($nilai % 100);
        } elseif ($nilai < 2000) {
            $temp = " seribu" . self::penyebut($nilai - 1000);
        } elseif ($nilai < 1000000) {
            $temp = self::penyebut($nilai / 1000) . " ribu" . self::penyebut($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            $temp = self::penyebut($nilai / 1000000) . " juta" . self::penyebut($nilai % 1000000);
        } elseif ($nilai < 1000000000000) {
            $temp = self::penyebut($nilai / 1000000000) . " milyar" . self::penyebut(fmod($nilai, 1000000000));
        } elseif ($nilai < 1000000000000000) {
            $temp = self::penyebut($nilai / 1000000000000) . " trilyun" . self::penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    public static function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(self::penyebut($nilai));
        } else {
            $hasil = trim(self::penyebut($nilai));
        }
        return ucfirst($hasil);
    }

    public static function convertPhone($nohp)
    {
        $nohp = str_replace(" ", "", $nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(", "", $nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")", "", $nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".", "", $nohp);
        // kadang ada penulisan np hp 0811-4242-2424
        $nohp = str_replace("-", "", $nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            // cek apakah no hp karakter 1-3 adalah +62
            if (substr(trim($nohp), 0, 3) == '62') {
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif (substr(trim($nohp), 0, 1) == '0') {
                $hp = '62' . substr(trim($nohp), 1);
            }
        }
        return $hp;
    }

    public static function getAlfabetByNumber($value)
    {

        $alphabet = range('A', 'Z');
        return $alphabet[$value]; // returns D
    }

    public static function echoNumber($value){

        return is_numeric($value) && $value > 0 ? $value : '';
    }
}
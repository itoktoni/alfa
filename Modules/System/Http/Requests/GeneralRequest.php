<?php

namespace Modules\System\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    private $rules;
    private $model;

    public function __construct()
    {
        $this->model = request()->route()->getController()::$model ?? false;
        $this->rules = request()->route()->getController()::$model->rules ?? [];

        if (request()->segment(3) == 'update' || request()->segment(3) == 'patch') {
            
            $collection = collect($this->rules)->map(function ($item, $key) {
                if (strpos($item, 'unique') !== false) {
                    $string = explode('|', $item);
                    $builder = '';
                    foreach ($string as $value) {
                        if (strpos($value, 'unique') === false) {
                            $builder = $builder . $value . '|';
                        }
                    }
                    $key = rtrim($builder, "|");
                } else {
                    $key = $item;
                }
                return $key;
            });

            $this->rules = $collection->toArray();
        }
    }

    public function prepareForValidation()
    {
        $this->merge([
            // 'content' => ''
        ]);
    }

    public function withValidator($validator)
    {
        // $validator->after(function ($validator) {
        //     $validator->errors()->add('system_action_code', 'The title cannot contain bad words!');
        // });
    }

    public function rules()
    {
        return $this->rules;
    }
}

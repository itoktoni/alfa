<?php

namespace Modules\System\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private $model;
    private $table;
    private $primaryKey;

    public function __construct()
    {
        $this->model = request()->route()->getController()::$model ?? false;
        $this->primaryKey = $this->model->getKeyName();
        $this->table = $this->model->getTable();
    }

    public function prepareForValidation()
    {
        $where = $code = $this->get('code');
        if ($this->has('target')) {
            
            $query = $this->model->select($this->primaryKey);
            $query = is_array($where) ? $query->whereIn($this->get('target'), $where) : $query->where($this->get('target'), $where);
            $code = $query->get();
            
            if ($code) {
                $code = $code->pluck($this->primaryKey)->toArray();
                $this->except('code');
            }
        }

        $this->merge([
            'data' => $where,
            'code' => $code,
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
        $target = $this->get('target');
        if ($target) {

            if (is_array($this->get('code'))) {
                return [
                    'code' => 'required|array',
                    'data.*' => 'exists:' . $this->table . ',' . $target,
                ];
            }

            return [
                'code' => 'required',
                'data' => 'exists:' . $this->table . ',' . $target,
            ];

        } else {
            return [
                'code.*' => 'exists:' . $this->table . ',' . $this->primaryKey,
            ];
        }

    }
}

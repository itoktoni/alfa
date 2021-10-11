<?php

namespace App\Rules;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;
use Plugin\Helper;

class Upload implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $error = '';
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return Helper::uploadImage($value, 'testing');
        } catch (\Throwable $th) {
            $this->error = $th->getMessage();
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error;
    }
}

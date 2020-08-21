<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OrUploadBukti implements Rule
{
    public $bukti1;
    public $bukti2;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($bukti1,$bukti2)
    {
        $this->bukti1 = $bukti1;
        $this->bukti2 = $bukti2;
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
        return $this->bukti1 == null || $this->bukti2 ==null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

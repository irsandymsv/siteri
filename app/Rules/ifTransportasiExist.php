<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ifTransportasiExist implements Rule
{
    public $transport;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($transport)
    {
        $transport=$this->transport;
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
        $transport!=null;
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

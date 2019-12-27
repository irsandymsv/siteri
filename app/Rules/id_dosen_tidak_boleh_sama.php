<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class id_dosen_tidak_boleh_sama implements Rule
{
    public $id_dosen;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id_dosen)
    {
        $this->id_dosen = $id_dosen;
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
        return $value != $this->id_dosen;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Dosen utama dan pendamping tidak boleh sama.';
    }
}

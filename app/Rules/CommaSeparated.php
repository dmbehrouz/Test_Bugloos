<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CommaSeparated implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
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
        return is_string($value) && preg_match('/^[\w\s\-\_]+(?:,[\w\s\-\_]+)*$/', $value);

    }

    public function message()
    {
        return 'The :attribute must be a comma-separated list and you can enter some signs like this; dash(-) and underscore(_)';
    }
}

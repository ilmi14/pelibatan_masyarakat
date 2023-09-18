<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class wordCount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $attribute;
    private $expected;

    public function __construct(int $expected)
    {
        $this->expected = $expected+1;
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
        $this->attribute = $attribute;
        $trimmed = trim($value);
        $numWords = count(explode(' ', $trimmed));
        return $numWords >= $this->expected;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The '.$this->attribute.' field must have minimal '.$this->expected.' words';
    }
}

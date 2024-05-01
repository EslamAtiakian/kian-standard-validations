<?php

namespace Kian\StandardValidations\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ShortTextRule implements ValidationRule
{
    protected int $minLength;
    protected int $maxLength;

    public function __construct($minLength = 5, $maxLength = 255)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = validator([$attribute => $value], [
            $attribute => [
                'string',
                'min:' . $this->minLength,
                'max:' . $this->maxLength]
        ]);

        // If the value doesn't pass the validation, return false
        if ($validator->fails()) {
            $fail ( 'The :attribute must be a string between ' . $this->minLength . ' and ' . $this->maxLength . ' characters.');
        }
    }

}

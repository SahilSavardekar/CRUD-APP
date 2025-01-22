<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use \App\Models\Products;

class ValidationRules implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if ($attribute === 'name' && Products::where('name', $value)->exists() && !is_string($value)) {
            $fail('The :attribute must be unique.');
        }
        if ($attribute === 'qty' && !is_numeric($value)) {
            $fail('The :attribute must be a valid quantity.');
        }
        if ($attribute === 'text' && !is_numeric($value)) {
            $fail('The :attribute must be a valid price.');
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseContactRequest extends FormRequest
{
    protected function commonRules(): array
    {
        return [
            'name'  => 'required|string|min:3|max:255',
            'phone' => 'required|string|min:10|max:15',
        ];
    }
}

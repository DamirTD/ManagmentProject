<?php

namespace App\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email обязателен для заполнения.',
            'email.string'      => 'Email должен быть строкой.',
            'email.email'       => 'Email должен быть действительным адресом электронной почты.',
            'password.required' => 'Пароль обязателен для заполнения.',
            'password.string'   => 'Пароль должен быть строкой.',
        ];
    }
}

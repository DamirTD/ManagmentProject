<?php

namespace App\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:45',
            'email'    => 'required|string|email|max:64|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Имя обязательно для заполнения.',
            'name.string'       => 'Имя должно быть строкой.',
            'name.max'          => 'Имя не должно превышать 45 символов.',
            'email.required'    => 'Email обязателен для заполнения.',
            'email.string'      => 'Email должен быть строкой.',
            'email.email'       => 'Email должен быть действительным адресом электронной почты.',
            'email.max'         => 'Email не должен превышать 64 символа.',
            'email.unique'      => 'Такой email уже зарегистрирован.',
            'password.required' => 'Пароль обязателен для заполнения.',
            'password.string'   => 'Пароль должен быть строкой.',
            'password.min'      => 'Пароль должен содержать минимум 6 символов.',
        ];
    }
}

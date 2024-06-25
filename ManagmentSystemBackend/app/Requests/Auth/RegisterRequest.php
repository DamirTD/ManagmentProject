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
            'firstName'   => 'required|string|max:255',
            'lastName'    => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:users',
            'phoneNumber' => 'nullable|string|max:20',
            'age'         => 'required|integer',
            'gender'      => 'required|string|in:male,female',
            'password'    => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'firstName.required' => 'Имя обязательно для заполнения.',
            'firstName.string'   => 'Имя должно быть строкой.',
            'firstName.max'      => 'Имя не должно превышать 255 символов.',
            'lastName.required'  => 'Фамилия обязательна для заполнения.',
            'lastName.string'    => 'Фамилия должна быть строкой.',
            'lastName.max'       => 'Фамилия не должна превышать 255 символов.',
            'email.required'     => 'Электронная почта обязательна для заполнения.',
            'email.string'       => 'Электронная почта должна быть строкой.',
            'email.email'        => 'Электронная почта должна быть действительным адресом.',
            'email.max'          => 'Электронная почта не должна превышать 255 символов.',
            'email.unique'       => 'Электронная почта уже занята.',
            'phoneNumber.string' => 'Номер телефона должен быть строкой.',
            'phoneNumber.max'    => 'Номер телефона не должен превышать 20 символов.',
            'age.required'       => 'Возраст обязателен для заполнения.',
            'age.integer'        => 'Возраст должен быть числом.',
            'gender.required'    => 'Пол обязателен для заполнения.',
            'gender.string'      => 'Пол должен быть строкой.',
            'gender.in'          => 'Пол должен быть либо "male", либо "female".',
            'password.required'  => 'Пароль обязателен для заполнения.',
            'password.string'    => 'Пароль должен быть строкой.',
            'password.min'       => 'Пароль должен содержать минимум :min символов.',
        ];
    }
}

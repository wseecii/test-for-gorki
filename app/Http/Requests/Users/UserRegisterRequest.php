<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:255', 'unique:users,login'],
            'password' => ['required', 'string', 'min:6'],
            'firstName' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'lastName' => ['sometimes', 'present', 'nullable', 'string', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'login.unique' => 'Данный логин уже зарегистрирован в системе',
            'password.min' => 'Минимальная длина пароля должна быть больше 6 символов',
        ];
    }
}

<?php

namespace App\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:128',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }
}

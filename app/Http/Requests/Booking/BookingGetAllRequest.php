<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingGetAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => ['sometimes', 'present', 'nullable', 'integer'],
            'offset' => ['sometimes', 'present', 'nullable', 'integer'],
            'status' => ['sometimes', 'present', 'nullable', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

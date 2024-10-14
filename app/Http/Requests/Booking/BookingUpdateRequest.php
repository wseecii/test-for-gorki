<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'number' => ['required', 'numeric'],
            'checkInDate' => ['sometimes', 'present', 'nullable', 'date'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

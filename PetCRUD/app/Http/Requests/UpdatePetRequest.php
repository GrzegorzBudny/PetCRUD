<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,sold,pending',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pet name is required.',
            'name.string' => 'Pet name must be a valid string.',
            'name.max' => 'Pet name cannot exceed 255 characters.',
            'status.required' => 'Pet status is required.',
            'status.in' => 'Pet status must be one of the following: available, sold, or pending.',
        ];
    }
}

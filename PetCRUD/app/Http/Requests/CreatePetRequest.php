<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePetRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,sold,pending',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The pet name is required.',
            'name.string' => 'The pet name must be a string.',
            'name.max' => 'The pet name may not be greater than 255 characters.',
            'status.required' => 'The pet status is required.',
            'status.in' => 'The pet status must be one of: available, sold, pending.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $guest = $this->route('guest');

        return [
            'firstname' => [
                'required', 
                'regex:/^[a-zA-Z\s]+$/', 
                'max:255'
            ],

            'lastname' => [
                'required', 
                'regex:/^[a-zA-Z\s]+$/', 
                'max:255'
            ],
            
            'email' => [
                'required', 
                'email', 'max:255', 
                Rule::unique('guests', 'email')->ignore($guest?->id),
            ],

            'profile_image' => [
                'nullable', 
                'image', 
                'mimes:jpg,jpeg,png,gif,webp', 
                'max:2048'
            ],
        ];
    }
}

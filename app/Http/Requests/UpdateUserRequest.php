<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:30',
            'prenom' => 'required|string|max:30',
            'pseudonyme' => 'required|string|max:30',
            // 'photo_profil' => 'nullable|image|mimes:jpg,svg,png|max:2048',
            'email' => 'required|string|max:100',
            'password' => 'required|string|max:255'
        ];
    }
}

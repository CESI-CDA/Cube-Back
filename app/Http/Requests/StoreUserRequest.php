<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "nom" => "required|string|max:30",
            "prenom" => "required|string|max:30",
            "pseudonyme" => "required|string|unique:users,pseudonyme|max:30",
            "email" => "required|email|unique:users,email|max:100",
            "password" => "required|string|max:255"
        ];
    }
}

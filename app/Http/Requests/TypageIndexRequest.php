<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypageIndexRequest extends FormRequest
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
            'per_page' => 'nullable|integer|min:1|max:100',
            'keyword' => 'nullable|string',
            'sort_by' => 'nullable|string',
            'sort_order' => 'nullable|string|in:asc,desc'
        ];
    }
}

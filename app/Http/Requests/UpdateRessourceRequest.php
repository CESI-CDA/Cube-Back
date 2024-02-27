<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRessourceRequest extends FormRequest
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
            'titre_res' => 'required|string|max:40',
            'contenu_res' => 'required|string',
            'url_res' => 'nullable|string',
            'id_type_res' => 'required|integer|exists:type_ressource,id',
            'id_rel' => 'required|integer|exists:type_ressource,id',
            'id_vis' => 'required|integer|exists:visibilite,id',
            'id_cat' => 'required|integer|exists:categorie,id'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLienRessourceCommentaireRequest extends FormRequest
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
            'id_res' => 'required|integer|exists:ressource,id',
            'id_user' => 'required|integer|exists:users,id',
            'date' => 'required|date|date_format:Y-m-d H:i:s',
            'commentaire' => 'nullable|string',
            'id_commentaire_parent' => 'nullable|integer|exists:lien_ressource_commentaire,id'
        ];
    }
}

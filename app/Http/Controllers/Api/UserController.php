<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *    path="/api/users",
     *    summary="Ajouter une utilisateur",
     *    description="",
     *    tags={"Users"},
     *   @OA\Parameter(
     *       name="nom",
     *       in="query",
     *       description="Nom de l'utilisateur",
     *       required=true
     *    ),
     * @OA\Parameter(
     *       name="prenom",
     *       in="query",
     *       description="Prénom de l'utilisateur",
     *       required=true
     *    ),
     * @OA\Parameter(
     *       name="email",
     *       in="query",
     *       description="Email de l'utilisateur",
     *       required=true
     *    ),
     * @OA\Parameter(
     *       name="password",
     *       in="query",
     *       description="Mot de passe de l'utilisateur",
     *       required=true
     *    ),
     *   @OA\Response(
     *       response=200,
     *       description="OK",
     *       @OA\MediaType(
     *           mediaType="application/json"
     *       )
     *    )
     *  )
     */

    public function store(StoreUserRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $ressource = User::create($validatedData);

            return response()->json([
                'status' => true,
                'ressource' => $ressource,
                'message' => 'L\'utilisateur a été créé avec succès.'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPhotoProfilRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Récupérer toutes les utilisateurs",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items to return per page (1-100)",
     *         @OA\Schema(type="integer", minimum=1, maximum=100)
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */
    public function index(Request $request)
    {
        try {
            $request->validate([
                'per_page' => 'integer|min:1|max:100'
            ]);

            $query = User::query();

            $items = $query->where('deleted', false)->paginate($request->input('per_page', 10));

            return response()->json([
                'status' => true,
                'items' => $items
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Récupérer un utilisateur spécifique",
     *     tags={"Users"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */
    public function show($id)
    {
        try {
            $item = User::where('deleted', false)->findOrFail($id);

            return response()->json([
                'status' => true,
                'item' => $item
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

     /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Ajouter un utilisateur",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "pseudonyme", "email", "password", "id_rol"},
     *             @OA\Property(property="nom", type="string", maxLength=30),
     *                 @OA\Property(property="prenom", type="string", maxLength=30),
     *                 @OA\Property(property="pseudonyme", type="string", maxLength=30),
     *                 @OA\Property(property="email", type="string", maxLength=100),
     *                 @OA\Property(property="password", type="string", maxLength=255),
     *                 @OA\Property(property="id_rol", type="integer"),
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function store(StoreUserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $item = User::create([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'pseudonyme' => $validatedData['pseudonyme'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'id_rol' => $validatedData['id_rol'],
            ]);


            // $timestamp = date('d-m-Y_H-i-s');
            // $chemin = 'photo_profils/' . $item->id . '/';
            // $nom = $timestamp . '.' . $validatedData['photo_profil']->extension();

            // $validatedData['photo_profil']->move(public_path($chemin), $nom);

            // $item->update([
            //     'photo_profil' => $chemin . $nom,
            // ]);

            return response()->json([
                'status' => true,
                'item' => $item,
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

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Modifier un utilisateur",
     *     tags={"Users"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "pseudonyme", "email", "password", "id_rol"},
     *             @OA\Property(property="nom",  type="string", maxLength=30),
     *             @OA\Property(property="prenom",  type="string", maxLength=30),
     *             @OA\Property(property="pseudonyme",  type="string", maxLength=30),
     *             @OA\Property(property="email",  type="string", maxLength=100),
     *             @OA\Property(property="id_rol", type="integer"),
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateUserRequest $updateUserRequest, $id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            $validatedData = $updateUserRequest->validated();
            $item = User::where('deleted', false)->findOrFail($id);
            $item->update($validatedData);

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'L\'utilisateur a été mise à jour avec succès.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'L\'utilisateur demandée n\'existe pas.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite lors de la mise à jour.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Supprimer un utilisateur",
     *     tags={"Users"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Item deleted successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */

    public function destroy($id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            User::where('deleted', false)->findOrFail($id)->update(['deleted' => true]);

            return response()->json([
                'status' => true,
                'message' => 'L\'utilisateur a été supprimé avec succès.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'L\'utilisateur demandé n\'existe pas.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite lors de la suppression.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/users/storePhotoProfil/{id}",
     *     summary="Ajouter une photo de profil",
     *     tags={"Users"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="photo_profil",
     *                     type="string",
     *                     format="binary",
     *                     description="Fichier de photo de profil"
     *                 ),
     *                 required={"photo_profil"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Création réussie de l'élément"),
     *     @OA\Response(response=422, description="Erreur de validation"),
     *     @OA\Response(response=500, description="Erreur interne du serveur"),
     * )
     */


    public function storePhotoProfil(StoreUserPhotoProfilRequest $request, $id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            $validatedData = $request->validated();
            $item = User::where('deleted', false)->findOrFail($id);
            $timestamp = date('d-m-Y_H-i-s');
            $chemin = 'photo_profils/' . $item->id . '/';
            $nom = $timestamp . '.' . $validatedData['photo_profil']->extension();

            $ancienNomFichier = basename($item->photo_profil);

            if (File::exists(public_path($chemin . $ancienNomFichier))) {
                File::move(public_path($chemin . $ancienNomFichier), public_path($chemin . 'old_' .$ancienNomFichier));
            }

            $validatedData['photo_profil']->move(public_path($chemin), $nom);

            $item->update([
                'photo_profil' => $chemin . $nom,
            ]);

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'La photo de profil a été ajoutée avec succès.'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'ajout de la photo de profil.',
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

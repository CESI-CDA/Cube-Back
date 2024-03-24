<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLienRessourceUserFavorisRequest;
use App\Models\LienRessourceUserFavoris;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="LienRessourceUserFavoris")
 */
class LienRessourceUserFavorisController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/liensRessourceUserFavoris/favorisFromUser/{id_user}",
 *     summary="Récupérer tous les favoris d'un utilisateur",
 *     tags={"LienRessourceUserFavoris"},
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Nombre d'éléments à renvoyer par page (1-100)",
 *         @OA\Schema(type="integer", minimum=1, maximum=100)
 *     ),
 *     @OA\Parameter(
 *         name="id_user",
 *         in="path",
 *         required=true,
 *         description="ID de l'utilisateur"
 *     ),
 *     @OA\Response(response=200, description="Opération réussie"),
 *     @OA\Response(response=500, description="Erreur interne du serveur"),
 * )
 */
    public function favorisFromUser($id_user)
    {
        try {
            $items = LienRessourceUserFavoris::where('deleted', false)->where('id_user', $id_user)->get();

            if ($items->isEmpty()) {
                throw new ModelNotFoundException("No query results for model [App\\Models\\LienRessourceUserFavoris] $id_user");
            }

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
     * @OA\Post(
     *     path="/api/liensRessourceUserFavoris",
     *     summary="Ajouter une ressource en favoris",
     *     tags={"LienRessourceUserFavoris"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_res", "id_user"},
     *             @OA\Property(property="id_res", type="integer"),
     *             @OA\Property(property="id_user", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */


    public function store(StoreLienRessourceUserFavorisRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $item = LienRessourceUserFavoris::create($validatedData);

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'La ressource a été ajoutée en favoris avec succès.'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'ajout de la ressource en favoris.',
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
     * @OA\Delete(
     
     *     path="/api/liensRessourceUserFavoris/{id_res}/{id_user}",
     *     summary="Supprimer une ressource des favoris",
     *     tags={"LienRessourceUserFavoris"},
     *     @OA\Parameter(name="id_res", in="path", required=true, description="ID of the ressource"),
     *     @OA\Parameter(name="id_user", in="path", required=true, description="ID of the user"),
     *     @OA\Response(response=200, description="Item deleted successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */

    public function destroy($id_res, $id_user)
    {
        try {
            if (!is_numeric($id_res) || $id_res <= 0 || !is_numeric($id_user) || $id_user <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            LienRessourceUserFavoris::where('deleted', false)->where('id_res', $id_res)->where('id_user', $id_user)->update(['deleted' => true]);

            return response()->json([
                'status' => true,
                'message' => 'La ressource a été supprimée des favoris avec succès.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'La ressource demandée n\'existe pas.',
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
}

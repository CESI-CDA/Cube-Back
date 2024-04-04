<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLienRessourceUserArchiveRequest;
use App\Models\LienRessourceUserArchive;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="LienRessourceUserArchive")
 */
class LienRessourceUserArchiveController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/liensRessourceUserArchive/archivesFromUser/{id_user}",
     *     summary="Récupérer tous les archives d'un utilisateur",
     *     tags={"LienRessourceUserArchive"},
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
    public function archivesFromUser($id_user)
    {
        try {
            $items = LienRessourceUserArchive::where('deleted', false)->where('id_user', $id_user)->get();

            if ($items->isEmpty()) {
                throw new ModelNotFoundException("No query results for model [App\\Models\\LienRessourceUserArchive] $id_user");
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
     * @OA\Get(
     *     path="/api/liensRessourceUserArchive/{id_res}/{id_user}",
     *     summary="Récupérer une lien d'archivage entre la ressource et l'utilisateur",
     *     tags={"LienRessourceUserArchive"},
     *     @OA\Parameter(name="id_res", in="path", required=true, description="ID of the item"),
     *     @OA\Parameter(name="id_user", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */
    public function show($id_res, $id_user)
    {
        try {
            if (!is_numeric($id_res) || $id_res <= 0 || !is_numeric($id_user) || $id_user <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            $item = LienRessourceUserArchive::where('deleted', false)->where('id_res', $id_res)->where('id_user', $id_user)->firstOrFail();

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
     *     path="/api/liensRessourceUserArchive",
     *     summary="Mettre en archive une ressource",
     *     tags={"LienRessourceUserArchive"},
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


    public function store(StoreLienRessourceUserArchiveRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $itemExist = LienRessourceUserArchive::where('id_res', $validatedData['id_res'])->where('id_user', $validatedData['id_user'])->first();

            if ($itemExist) {
                LienRessourceUserArchive::where('id_res', $validatedData['id_res'])
                ->where('id_user', $validatedData['id_user'])
                ->update(['deleted' => 0]);
            } else {
                LienRessourceUserArchive::create($validatedData);
            }

            $item = LienRessourceUserArchive::where('id_res', $validatedData['id_res'])->where('id_user', $validatedData['id_user'])->firstOrFail();

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'La ressource a été archivée avec succès.'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'ajout de l\'archivage de la ressource.',
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
     
     *     path="/api/liensRessourceUserArchive/{id_res}/{id_user}",
     *     summary="Supprimer une ressource des archives",
     *     tags={"LienRessourceUserArchive"},
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
            LienRessourceUserArchive::where('deleted', false)->where('id_res', $id_res)->where('id_user', $id_user)->update(['deleted' => true]);

            return response()->json([
                'status' => true,
                'message' => 'La ressource a été supprimée des archives avec succès.'
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

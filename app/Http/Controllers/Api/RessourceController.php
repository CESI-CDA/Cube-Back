<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\UpdateRessourceRequest;
use App\Models\Ressource;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Ressources")
 */
class RessourceController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/ressources",
     *     summary="Récupérer toutes les ressources",
     *     tags={"Ressources"},
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

            $query = Ressource::query();

            $items = $query->with('getTypeRessource', 'getRelationRessource', 'getVisibiliteRessource', 'getCategorieRessource')->paginate($request->input('per_page', 10));

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
     *     path="/api/ressources/{id}",
     *     summary="Récupérer une ressource spécifique",
     *     tags={"Ressources"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */
    public function show($id)
    {
        try {
            $item = Ressource::with('getTypeRessource', 'getRelationRessource', 'getVisibiliteRessource', 'getCategorieRessource')->findOrFail($id);

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
     *     path="/api/ressources",
     *     summary="Créer une ressource",
     *     tags={"Ressources"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titre_res", "contenu_res", "id_type_res", "id_rel", "id_vis", "id_cat"},
     *             @OA\Property(property="titre_res",  type="string", maxLength=40),
     *             @OA\Property(property="contenu_res",  type="string"),
     *             @OA\Property(property="url_res",  type="string"),
     *             @OA\Property(property="id_type_res",  type="integer"),
     *             @OA\Property(property="id_rel",  type="integer"),
     *             @OA\Property(property="id_vis",  type="integer"),
     *             @OA\Property(property="id_cat",  type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function store(StoreRessourceRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $item = Ressource::create($validatedData);

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'La ressource a été créée avec succès.'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création de la ressource.',
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
     *     path="/api/ressources/{id}",
     *     summary="Modifier une ressource",
     *     tags={"Ressources"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titre_res", "contenu_res", "id_type_res", "id_rel", "id_vis", "id_cat"},
     *             @OA\Property(property="titre_res",  type="string", maxLength=40),
     *             @OA\Property(property="contenu_res",  type="string"),
     *             @OA\Property(property="url_res",  type="string"),
     *             @OA\Property(property="id_type_res",  type="integer"),
     *             @OA\Property(property="id_rel",  type="integer"),
     *             @OA\Property(property="id_vis",  type="integer"),
     *             @OA\Property(property="id_cat",  type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateRessourceRequest $request, $id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            $validatedData = $request->validated();
            $item = Ressource::findOrFail($id);
            $item->update($validatedData);

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'La ressource a été mise à jour avec succès.'
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
                'message' => 'Une erreur s\'est produite lors de la mise à jour.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

     /**
     * @OA\Delete(
     *     path="/api/ressources/{id}",
     *     summary="Supprimer une ressource",
     *     tags={"Ressources"},
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
            $item = Ressource::findOrFail($id);
            $item->delete();

            return response()->json([
                'status' => true,
                'message' => 'La ressource a été supprimée avec succès.'
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

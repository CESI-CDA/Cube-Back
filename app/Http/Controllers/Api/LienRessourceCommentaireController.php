<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLienRessourceCommentaireRequest;
use App\Http\Requests\UpdateLienRessourceCommentaireRequest;
use App\Models\LienRessourceCommentaire;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="LienRessourceCommentaire")
 */
class LienRessourceCommentaireController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/liensRessourceCommentaire/{id}",
     *     summary="Récupérer un commentaire spécifique",
     *     tags={"LienRessourceCommentaire"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */
    public function show($id)
    {
        try {
            $item = LienRessourceCommentaire::where('deleted', false)->findOrFail($id);

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
     *     path="/api/liensRessourceCommentaire",
     *     summary="Créer un commentaire",
     *     tags={"LienRessourceCommentaire"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_res", "id_user", "date", "commentaire"},
     *             @OA\Property(property="id_res",  type="integer"),
     *             @OA\Property(property="id_user",  type="integer"),
     *             @OA\Property(property="date",  type="string", format="date-time"),
     *             @OA\Property(property="commentaire",  type="string"),
     *             @OA\Property(property="id_commentaire_parent",  type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item créé avec succès"),
     *     @OA\Response(response=422, description="Erreur de validation"),
     *     @OA\Response(response=500, description="Erreur interne du serveur")
     * )
     */


    public function store(StoreLienRessourceCommentaireRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $item = LienRessourceCommentaire::create($validatedData);

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'Le commentaire a été créé avec succès.'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création du commentaire.',
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
     *     path="/api/liensRessourceCommentaire/{id}",
     *     summary="Modifier un commentaire",
     *     tags={"LienRessourceCommentaire"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"commentaire"},
     *             @OA\Property(property="commentaire",  type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateLienRessourceCommentaireRequest $request, $id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            $validatedData = $request->validated();
            $item = LienRessourceCommentaire::where('deleted', false)->findOrFail($id);
            $item->update($validatedData);

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'Le commentaire a été mis à jour avec succès.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Le commentaire demandé n\'existe pas.',
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
     *     path="/api/liensRessourceCommentaire/{id}",
     *     summary="Supprimer un commentaire",
     *     tags={"LienRessourceCommentaire"},
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
            LienRessourceCommentaire::where('deleted', false)->findOrFail($id)->update(['deleted' => true]);

            return response()->json([
                'status' => true,
                'message' => 'Le commentaire a été supprimé avec succès.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Le commentaire demandé n\'existe pas.',
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

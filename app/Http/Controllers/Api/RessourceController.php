<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\UpdateRessourceRequest;
use App\Models\LienRessourceCategorie;
use App\Models\LienRessourceRelation;
use App\Models\Ressource;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Ressource")
 */
class RessourceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/ressources",
     *     summary="Récupérer toutes les ressources",
     *     tags={"Ressource"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items to return per page (1-100)",
     *         @OA\Schema(type="integer", minimum=1, maximum=100)
     *     ),
     *     @OA\Parameter(
     *         name="keywordTitreRes",
     *         in="query",
     *         description="Keyword for searching items by keywordTitreRes",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="keywordIdTypeRes",
     *         in="query",
     *         description="Keyword for searching items by keywordIdTypeRes",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="keywordIdRel",
     *         in="query",
     *         description="Keyword for searching items by keywordIdRel",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="keywordIdVis",
     *         in="query",
     *         description="Keyword for searching items by keywordIdVis",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="keywordIdCat",
     *         in="query",
     *         description="Keyword for searching items by keywordIdCat",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="keywordIdCreateur",
     *         in="query",
     *         description="Keyword for searching items by keywordIdCreateur",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */
    public function index(Request $request)
    {
        try {
            $request->validate([
                'per_page' => 'integer|min:1|max:100',
                'keywordTitreRes' => 'nullable|string|max:40',
                'keywordIdTypeRes' => 'nullable|integer|exists:type_ressource,id',
                'keywordIdRel' => 'nullable|integer|exists:relation,id',
                'keywordIdVis' => 'nullable|integer|exists:visibilite,id',
                'keywordIdCat' => 'nullable|integer|exists:categorie,id',
                'keywordIdCreateur' => 'nullable|integer|exists:users,id'
            ]);

            $query = Ressource::query();

            if ($request->has('keywordTitreRes') && $request->input('keywordTitreRes') !== null && $request->input('keywordTitreRes') !== 'undefined') {
                $keywordTitreRes = $request->input('keywordTitreRes');
                $query->where('ressource.titre_res', 'like', "%$keywordTitreRes%");
            }

            if ($request->has('keywordIdTypeRes') && $request->input('keywordIdTypeRes') !== null && $request->input('keywordIdTypeRes') !== 'undefined') {
                $keywordIdTypeRes = $request->input('keywordIdTypeRes');
                $query->where('ressource.id_type_res', $keywordIdTypeRes);
            }

            if ($request->has('keywordIdRel') && $request->input('keywordIdRel') !== null && $request->input('keywordIdRel') !== 'undefined') {
                $keywordIdRel = $request->input('keywordIdRel');
                $query->whereHas('getLienRessourceRelation', function ($relationQuery) use ($keywordIdRel) {
                    $relationQuery->where('id_rel', $keywordIdRel);
                });
            }

            if ($request->has('keywordIdVis') && $request->input('keywordIdVis') !== null && $request->input('keywordIdVis') !== 'undefined') {
                $keywordIdVis = $request->input('keywordIdVis');
                $query->where('ressource.id_vis', $keywordIdVis);
            }

            if ($request->has('keywordIdCat') && $request->input('keywordIdCat') !== null && $request->input('keywordIdCat') !== 'undefined') {
                $keywordIdCat = $request->input('keywordIdCat');
                $query->whereHas('getLienRessourceCategorie', function ($relationQuery) use ($keywordIdCat) {
                    $relationQuery->where('id_cat', $keywordIdCat);
                });
            }

            if ($request->has('keywordIdCreateur') && $request->input('keywordIdCreateur') !== null && $request->input('keywordIdCreateur') !== 'undefined') {
                $keywordIdCreateur = $request->input('keywordIdCreateur');
                $query->where('ressource.id_createur', $keywordIdCreateur);
            }

            $items = $query->where('deleted', false)->with('getTypeRessource', 'getVisibilite', 'getCreateur', 'getLienRessourceRelation', 'getLienRessourceRelation.getRelationRessource', 'getLienRessourceCategorie', 'getLienRessourceCategorie.getCategorie')->paginate($request->input('per_page', 10));

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
     *     tags={"Ressource"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */
    public function show($id)
    {
        try {
            $item = Ressource::where('deleted', false)->with('getTypeRessource', 'getVisibilite', 'getCreateur', 'getLienRessourceRelation', 'getLienRessourceRelation.getRelationRessource', 'getLienRessourceCategorie', 'getLienRessourceCategorie.getCategorie')->findOrFail($id);

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
     *     tags={"Ressource"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titre_res", "contenu_res", "id_type_res", "id_vis", "id_createur", "arrayIdCat", "arrayIdRel"},
     *             @OA\Property(property="titre_res",  type="string", maxLength=40),
     *             @OA\Property(property="contenu_res",  type="string"),
     *             @OA\Property(property="url_res",  type="string"),
     *             @OA\Property(property="id_type_res",  type="integer"),
     *             @OA\Property(property="id_vis",  type="integer"),
     *             @OA\Property(property="id_createur",  type="integer"),
     *             @OA\Property(property="arrayIdRel",  type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="arrayIdCat",  type="array", @OA\Items(type="integer"))
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */


    public function store(StoreRessourceRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $ressource = Ressource::create([
                'titre_res' => $validatedData['titre_res'],
                'contenu_res' => $validatedData['contenu_res'],
                'url_res' => $validatedData['url_res'],
                'id_type_res' => $validatedData['id_type_res'],
                'id_vis' => $validatedData['id_vis'],
                'id_createur' => $validatedData['id_createur']
            ]);

            foreach ($validatedData['arrayIdCat'] as $categorie) {
                LienRessourceCategorie::create([
                    'id_res' => $ressource->id,
                    'id_cat' => $categorie
                ]);
            }

            foreach ($validatedData['arrayIdRel'] as $relation) {
                LienRessourceRelation::create([
                    'id_res' => $ressource->id,
                    'id_rel' => $relation
                ]);
            }

            $item = $ressource->fresh('getLienRessourceRelation', 'getLienRessourceCategorie');

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
     *     tags={"Ressource"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"titre_res", "contenu_res", "id_type_res", "id_vis", "id_createur", "arrayIdCat", "arrayIdRel"},
     *             @OA\Property(property="titre_res",  type="string", maxLength=40),
     *             @OA\Property(property="contenu_res",  type="string"),
     *             @OA\Property(property="url_res",  type="string"),
     *             @OA\Property(property="id_type_res",  type="integer"),
     *             @OA\Property(property="id_vis",  type="integer"),
     *             @OA\Property(property="id_createur",  type="integer"),
     *             @OA\Property(property="arrayIdRel",  type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="arrayIdCat",  type="array", @OA\Items(type="integer"))
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

            $ressource = Ressource::where('deleted', false)->findOrFail($id);

            $ressource->update([
                'titre_res' => $validatedData['titre_res'],
                'contenu_res' => $validatedData['contenu_res'],
                'url_res' => $validatedData['url_res'],
                'id_type_res' => $validatedData['id_type_res'],
                'id_vis' => $validatedData['id_vis'],
                'id_createur' => $validatedData['id_createur']
            ]);

            $existingCategories = $ressource->getLienRessourceCategorie->pluck('id_cat')->toArray();
            $requestedCategories = $validatedData['arrayIdCat'];

            $categoriesToAdd = array_diff($requestedCategories, $existingCategories);
            $categoriesToRemove = array_diff($existingCategories, $requestedCategories);

            foreach ($categoriesToAdd as $categorie) {
                $lienRessourceCategories = LienRessourceCategorie::where('id_res', $ressource->id)
                    ->where('id_cat', $categorie)
                    ->first();

                if (!$lienRessourceCategories) {
                    $lienRessourceCategories = LienRessourceCategorie::create([
                        'id_res' => $ressource->id,
                        'id_cat' => $categorie
                    ]);
                } elseif ($lienRessourceCategories->deleted == true) {
                    LienRessourceCategorie::where('id_res', $ressource->id)
                        ->where('id_cat', $categorie)
                        ->update(['deleted' => false]);
                }
            }

            LienRessourceCategorie::whereIn('id_cat', $categoriesToRemove)
                ->where('id_res', $ressource->id)
                ->update(['deleted' => true]);

            $existingRelations = $ressource->getLienRessourceRelation->pluck('id_rel')->toArray();
            $requestedRelations = $validatedData['arrayIdRel'];

            $relationsToAdd = array_diff($requestedRelations, $existingRelations);
            $relationsToRemove = array_diff($existingRelations, $requestedRelations);

            foreach ($relationsToAdd as $relation) {
                $lienRessourceRelations = LienRessourceRelation::where('id_res', $ressource->id)
                    ->where('id_rel', $relation)
                    ->first();

                if (!$lienRessourceRelations) {
                    $lienRessourceRelations = LienRessourceRelation::create([
                        'id_res' => $ressource->id,
                        'id_rel' => $relation
                    ]);
                } elseif ($lienRessourceRelations->deleted == true) {
                    LienRessourceRelation::where('id_res', $ressource->id)
                        ->where('id_rel', $relation)
                        ->update(['deleted' => false]);
                }

            }

            LienRessourceRelation::whereIn('id_rel', $relationsToRemove)
                ->where('id_res', $ressource->id)
                ->update(['deleted' => true]);

            $item = $ressource->fresh('getLienRessourceRelation', 'getLienRessourceCategorie');

            return response()->json([
                'status' => true,
                'item' => $item,
                'message' => 'La ressource a été mise à jour avec succès.'
            ], 200);
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
     *     tags={"Ressource"},
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

            Ressource::findOrFail($id)->update(['deleted' => true]);

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

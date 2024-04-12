<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Http\Requests\UpdateRessourceRequest;
use App\Models\LienRessourceCategorie;
use App\Models\LienRessourceRelation;
use App\Models\Ressource;
use App\Services\DefaultService;
use App\Services\HandleService;
use DateTime;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Ressource")
 */
class RessourceController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }
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
     *         name="sort_by",
     *         in="query",
     *         description="Field to sort items by",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sort_order",
     *         in="query",
     *         description="Sort order (asc or desc)",
     *         @OA\Schema(type="string", enum={"asc", "desc"})
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
                'sort_by' => 'string|nullable',
                'sort_order' => 'string|in:asc,desc',
                'keywordTitreRes' => 'nullable|string|max:40',
                'keywordIdTypeRes' => 'nullable|integer|exists:type_ressource,id',
                'keywordIdRel' => 'nullable|integer|exists:relation,id',
                'keywordIdVis' => 'nullable|integer|exists:visibilite,id',
                'keywordIdCat' => 'nullable|integer|exists:categorie,id',
                'keywordIdCreateur' => 'nullable|integer|exists:users,id',
                'keywordDateDebutCreation' => 'nullable|date',
                'keywordDateFinCreation' => 'nullable|date',
                'keywordIsArchive' => 'nullable|boolean',
            ]);

            $query = Ressource::query()->where('deleted', false);

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

            if ($request->has('keywordDateDebutCreation') && $request->input('keywordDateDebutCreation') !== null && $request->input('keywordDateDebutCreation') !== 'undefined' && $request->has('keywordDateFinCreation') && $request->input('keywordDateFinCreation') !== null && $request->input('keywordDateFinCreation') !== 'undefined') {
                $date_debut = $request->input('keywordDateDebutCreation');
                $date_fin = $request->input('keywordDateFinCreation');
                $query->whereBetween('date_creation', [$date_debut, $date_fin]);
            }

            if ($request->has('keywordIsArchive') && $request->input('keywordIsArchive') !== null && $request->input('keywordIsArchive') !== 'undefined') {
                $keywordIsArchive = $request->input('keywordIsArchive');
                $query->where('ressource.is_archive', $keywordIsArchive);
            }

            $sortColumn = $request->input('sort_by', 'date_creation');
            $sortOrder = $request->input('sort_order', 'desc');
            $query->orderBy($sortColumn, $sortOrder);

            $items = $query->with('getTypeRessource', 'getVisibilite', 'getCreateur', 'getLienRessourceRelation', 'getLienRessourceRelation.getRelationRessource', 'getLienRessourceCategorie', 'getLienRessourceCategorie.getCategorie')->paginate($request->input('per_page', 10));

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
            $validatedId = $this->defaultService->checkIdType($id);
            $item = Ressource::where('deleted', 0)->with('getTypeRessource', 'getVisibilite', 'getCreateur', 'getLienRessourceRelation', 'getLienRessourceRelation.getRelationRessource', 'getLienRessourceCategorie', 'getLienRessourceCategorie.getCategorie', 'getLienRessourceCommentaire')->findOrFail($validatedId);
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
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

    public function store(StoreRessourceRequest $storeRessourceRequest)
    {
        try {
            $validatedData = $storeRessourceRequest->validated();
            $ressource = Ressource::create([
                'titre_res' => $validatedData['titre_res'],
                'contenu_res' => $validatedData['contenu_res'],
                'url_res' => $validatedData['url_res'],
                'id_type_res' => $validatedData['id_type_res'],
                'id_vis' => $validatedData['id_vis'],
                'id_createur' => $validatedData['id_createur'],
                'date_creation' => (new DateTime())->format('Y-m-d H:i:s'),
                'is_archive' => 0
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
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
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
     *             required={"titre_res", "contenu_res", "id_type_res", "id_vis", "id_createur", "arrayIdCat", "arrayIdRel", "is_archive"},
     *             @OA\Property(property="titre_res",  type="string", maxLength=40),
     *             @OA\Property(property="contenu_res",  type="string"),
     *             @OA\Property(property="url_res",  type="string"),
     *             @OA\Property(property="id_type_res",  type="integer"),
     *             @OA\Property(property="id_vis",  type="integer"),
     *             @OA\Property(property="id_createur",  type="integer"),
     *             @OA\Property(property="arrayIdRel",  type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="arrayIdCat",  type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="is_archive",  type="boolean"),
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateRessourceRequest $updateRessourceRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $updateRessourceRequest->validated();

            $ressource = Ressource::where('deleted', false)->findOrFail($validatedId);

            $ressource->update([
                'titre_res' => $validatedData['titre_res'],
                'contenu_res' => $validatedData['contenu_res'],
                'url_res' => $validatedData['url_res'],
                'id_type_res' => $validatedData['id_type_res'],
                'id_vis' => $validatedData['id_vis'],
                'id_createur' => $validatedData['id_createur'],
                'is_archive' => $validatedData['is_archive']
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

            return $this->handleService->handleSuccessUpdate($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorUpdate($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
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
            $validatedId = $this->defaultService->checkIdType($id);
            Ressource::where('deleted', 0)->findOrFail($validatedId)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/ressources/ressourcesCreeFromUtilisateur/{id_user}",
     *     summary="Récupérer toutes les ressources crées par un utilisateur",
     *     tags={"Ressource"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items to return per page (1-100)",
     *         @OA\Schema(type="integer", minimum=1, maximum=100)
     *     ),
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Keyword for searching items",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Field to sort items by",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sort_order",
     *         in="query",
     *         description="Sort order (asc or desc)",
     *         @OA\Schema(type="string", enum={"asc", "desc"})
     *     ),
     *     @OA\Parameter(name="id_user", in="path", required=true, description="ID of the user"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */

    public function ressourcesCreeFromUtilisateur(TypageIndexRequest $typageIndexRequest, $id_user)
    {
        try {
            $queryModel = Ressource::query()->where('deleted', 0)->where('id_createur', $id_user);
            $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['titre_res'], ['getTypeRessource', 'getVisibilite', 'getCreateur', 'getLienRessourceRelation', 'getLienRessourceRelation.getRelationRessource', 'getLienRessourceCategorie', 'getLienRessourceCategorie.getCategorie']);
            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

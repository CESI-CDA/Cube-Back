<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use App\Services\DefaultService;
use App\Services\HandleService;

/**
 * @OA\Tag(name="Categorie")
 */
class CategorieController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Récupérer toutes les catégories",
     *     tags={"Categorie"},
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
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */

    public function index(TypageIndexRequest $typageIndexRequest)
    {
        try {
            $queryModel = Categorie::query()->where('deleted', 0);
            $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['intitule_cat'], []);
            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     summary="Récupérer une catégorie spécifique",
     *     tags={"Categorie"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */

    public function show($id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $item = Categorie::where('deleted', 0)->findOrFail($validatedId);
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Créer une catégorie",
     *     tags={"Categorie"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"intitule_cat"},
     *             @OA\Property(property="intitule_cat",  type="string", maxLength=30)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */
    public function store(StoreCategorieRequest $storeCategorieRequest)
    {
        try {
            $validatedData = $storeCategorieRequest->validated();
            $item = Categorie::create($validatedData);
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     summary="Modifier une catégorie",
     *     tags={"Categorie"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"intitule_cat"},
     *             @OA\Property(property="intitule_cat",  type="string", maxLength=30)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateCategorieRequest $updateCategorieRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $updateCategorieRequest->validated();
            $item = Categorie::where('deleted', 0)->findOrFail($validatedId);
            $item->update($validatedData);
            return $this->handleService->handleSuccessUpdate($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorUpdate($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     summary="Supprimer une catégorie",
     *     tags={"Categorie"},
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
            Categorie::where('deleted', 0)->findOrFail($validatedId)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

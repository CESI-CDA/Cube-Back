<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisibiliteRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Http\Requests\UpdateVisibiliteRequest;
use App\Models\Visibilite;
use App\Services\DefaultService;
use App\Services\HandleService;

/**
 * @OA\Tag(name="Visibilite")
 */
class VisibiliteController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/visibilites",
     *     summary="Récupérer toutes les visibilitées",
     *     tags={"Visibilite"},
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
            $queryModel = Visibilite::query()->where('deleted', 0);
            $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['intitule_vis'], []);
            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/visibilites/{id}",
     *     summary="Récupérer une visibilité spécifique",
     *     tags={"Visibilite"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */

    public function show($id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $item = Visibilite::where('deleted', 0)->findOrFail($validatedId);
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/visibilites",
     *     summary="Créer une visibilité",
     *     tags={"Visibilite"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"intitule_vis"},
     *             @OA\Property(property="intitule_vis",  type="string", maxLength=30)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function store(StoreVisibiliteRequest $storeVisibiliteRequest)
    {
        try {
            $validatedData = $storeVisibiliteRequest->validated();
            $item = Visibilite::create($validatedData);
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/visibilites/{id}",
     *     summary="Modifier une visibilité",
     *     tags={"Visibilite"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"intitule_vis"},
     *             @OA\Property(property="intitule_vis",  type="string", maxLength=30)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateVisibiliteRequest $updateVisibiliteRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $updateVisibiliteRequest->validated();
            $item = Visibilite::where('deleted', 0)->findOrFail($validatedId);
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
     *     path="/api/visibilites/{id}",
     *     summary="Supprimer une visibilité",
     *     tags={"Visibilite"},
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
            Visibilite::where('deleted', 0)->findOrFail($validatedId)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

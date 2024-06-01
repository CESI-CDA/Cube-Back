<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLienUserRestrictionRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Http\Requests\UpdateLienUserRestrictionRequest;
use App\Models\LienUserRestriction;
use App\Models\User;
use App\Services\DefaultService;
use App\Services\HandleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(name="LienUserRestriction")
 */
class LienUserRestrictionController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/liens-user-restriction",
     *     summary="Récupérer toutes les ressources",
     *     tags={"LienUserRestriction"},
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
            $queryModel = LienUserRestriction::query()->where('deleted', 0);
            $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['date'], ['getUser']);
            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/liens-user-restriction/{id}",
     *     summary="Récupérer une catégorie spécifique",
     *     tags={"LienUserRestriction"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */

    public function show($id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $item = LienUserRestriction::where('deleted', 0)->with('getUser')->findOrFail($validatedId);
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/liens-user-restriction",
     *     summary="Restreindre un user",
     *     tags={"LienUserRestriction"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_user", "date"},
     *             @OA\Property(property="id_user",  type="integer"),
     *             @OA\Property(property="date",  type="string", example="2024-08-08 07:13:21"),
     *             @OA\Property(property="commentaire",  type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */
    public function store(StoreLienUserRestrictionRequest $storeLienUserRestrictionRequest)
    {
        try {
            $validatedData = $storeLienUserRestrictionRequest->validated();
            $item = LienUserRestriction::create($validatedData);
            $userRestricted = User::where('deleted', 0)->findOrFail($validatedData['id_user']);
            $userRestricted->tokens()->delete();
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/liens-user-restriction/{id}",
     *     summary="Modifier une restriction",
     *     tags={"LienUserRestriction"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"date"},
     *             @OA\Property(property="date",  type="string", example="2024-08-08 07:13:21"),
     *             @OA\Property(property="commentaire",  type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateLienUserRestrictionRequest $updateLienUserRestrictionRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $updateLienUserRestrictionRequest->validated();
            $item = LienUserRestriction::where('deleted', 0)->findOrFail($validatedId);
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
     *     path="/api/liens-user-restriction/{id}",
     *     summary="Supprimer une catégorie",
     *     tags={"LienUserRestriction"},
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
            LienUserRestriction::where('deleted', 0)->findOrFail($validatedId)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

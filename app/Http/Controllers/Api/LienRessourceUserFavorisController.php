<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLienRessourceUserFavorisRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Models\LienRessourceUserFavoris;
use App\Services\DefaultService;
use App\Services\HandleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @OA\Tag(name="LienRessourceUserFavoris")
 */
class LienRessourceUserFavorisController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }
    /**
     * @OA\Get(
     *     path="/api/liensRessourceUserFavoris/favorisFromUser/{id_user}",
     *     summary="Récupérer toutes les favoris d'un utilisateur",
     *     tags={"LienRessourceUserFavoris"},
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
     *     @OA\Parameter(
     *         name="id_user",
     *         in="path",
     *         required=true,
     *         description="ID de l'utilisateur"
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */

    public function favorisFromUser(TypageIndexRequest $typageIndexRequest, $id_user)
    {
        try {
            $validatedIdUser = $this->defaultService->checkIdType($id_user);
            $queryModel = LienRessourceUserFavoris::query()->where('deleted', 0)->where('id_user', $validatedIdUser);
            $result = $queryModel->exists();
            if (!$result) {
                throw new ModelNotFoundException("Aucun résultat pour l'utilisateur spécifié");
            } else {
                $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['id_res'], []);
                return $this->handleService->handleSuccessIndex($items);
            }
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/liensRessourceUserFavoris/{id_res}/{id_user}",
     *     summary="Récupérer une lien favoris entre la ressource et l'utilisateur",
     *     tags={"LienRessourceUserFavoris"},
     *     @OA\Parameter(name="id_res", in="path", required=true, description="ID of the item"),
     *     @OA\Parameter(name="id_user", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */

    public function show($id_res, $id_user)
    {
        try {
            $validatedIdRes = $this->defaultService->checkIdType($id_res);
            $validatedIdUser = $this->defaultService->checkIdType($id_user);
            $item = LienRessourceUserFavoris::where('deleted', 0)->where('id_res', $validatedIdRes)->where('id_user', $validatedIdUser)->firstOrFail();
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
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

    public function store(StoreLienRessourceUserFavorisRequest $storeLienRessourceUserFavorisRequest)
    {
        try {
            $validatedData = $storeLienRessourceUserFavorisRequest->validated();
            $itemExist = LienRessourceUserFavoris::where('id_res', $validatedData['id_res'])->where('id_user', $validatedData['id_user'])->first();

            if ($itemExist) {
                LienRessourceUserFavoris::where('id_res', $validatedData['id_res'])
                    ->where('id_user', $validatedData['id_user'])
                    ->update(['deleted' => 0]);
            } else {
                LienRessourceUserFavoris::create($validatedData);
            }
            $item = LienRessourceUserFavoris::where('id_res', $validatedData['id_res'])->where('id_user', $validatedData['id_user'])->firstOrFail();
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
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
            $validatedIdRes = $this->defaultService->checkIdType($id_res);
            $validatedIdUser = $this->defaultService->checkIdType($id_user);
            LienRessourceUserFavoris::where('deleted', 0)->where('id_res', $validatedIdRes)->where('id_user', $validatedIdUser)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

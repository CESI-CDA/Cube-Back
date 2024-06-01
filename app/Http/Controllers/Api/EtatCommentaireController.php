<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEtatCommentaireRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Http\Requests\UpdateEtatCommentaireRequest;
use App\Models\EtatCommentaire;
use App\Services\DefaultService;
use App\Services\HandleService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="EtatCommentaire")
 */
class EtatCommentaireController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/etat-commentaire",
     *     summary="Récupérer tout les états des commentaires",
     *     tags={"EtatCommentaire"},
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
            $queryModel = EtatCommentaire::query()->where('deleted', 0);
            $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['intitule'], []);
            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/etat-commentaire/{id}",
     *     summary="Récupérer un état de commentaire spécifique",
     *     tags={"EtatCommentaire"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */

    public function show($id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $item = EtatCommentaire::where('deleted', 0)->findOrFail($validatedId);
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/etat-commentaire",
     *     summary="Créer un état de commentaire",
     *     tags={"EtatCommentaire"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"intitule"},
     *             @OA\Property(property="intitule",  type="string", maxLength=50)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */
    public function store(StoreEtatCommentaireRequest $storeEtatCommentaireRequest)
    {
        try {
            $validatedData = $storeEtatCommentaireRequest->validated();
            $item = EtatCommentaire::create($validatedData);
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/etat-commentaire/{id}",
     *     summary="Modifier un état de commentaire",
     *     tags={"EtatCommentaire"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"intitule"},
     *             @OA\Property(property="intitule",  type="string", maxLength=50)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(UpdateEtatCommentaireRequest $updateEtatCommentaireRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $updateEtatCommentaireRequest->validated();
            $item = EtatCommentaire::where('deleted', 0)->findOrFail($validatedId);
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
     *     path="/api/etat-commentaire/{id}",
     *     summary="Supprimer un état de commentaire",
     *     tags={"EtatCommentaire"},
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
            EtatCommentaire::where('deleted', 0)->findOrFail($validatedId)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

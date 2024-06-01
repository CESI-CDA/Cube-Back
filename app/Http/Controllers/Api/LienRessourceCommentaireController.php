<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLienRessourceCommentaireRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Http\Requests\UpdateEtatLienRessourceCommentaireRequest;
use App\Http\Requests\UpdateLienRessourceCommentaireRequest;
use App\Models\LienRessourceCommentaire;
use App\Services\DefaultService;
use App\Services\HandleService;

/**
 * @OA\Tag(name="LienRessourceCommentaire")
 */
class LienRessourceCommentaireController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }
    /**
     * @OA\Get(
     *     path="/api/liensRessourceCommentaire",
     *     summary="Récupérer toutes les commentaires en attente",
     *     tags={"LienRessourceCommentaire"},
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
            $queryModel = LienRessourceCommentaire::query()->where('deleted', 0)->where('id_etat', 1);
            $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['date', 'commentaire'], []);
            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
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
            $validatedId = $this->defaultService->checkIdType($id);
            $item = LienRessourceCommentaire::where('deleted', 0)->findOrFail($validatedId);
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
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
     *             @OA\Property(property="date",  type="string", example="2024-04-04 07:13:21"),
     *             @OA\Property(property="commentaire",  type="string"),
     *             @OA\Property(property="id_commentaire_parent",  type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item créé avec succès"),
     *     @OA\Response(response=422, description="Erreur de validation"),
     *     @OA\Response(response=500, description="Erreur interne du serveur")
     * )
     */

    public function store(StoreLienRessourceCommentaireRequest $storeLienRessourceCommentaireRequest)
    {
        try {
            $validatedData = $storeLienRessourceCommentaireRequest->validated();
            $item = LienRessourceCommentaire::create([
                'id_res' => $validatedData['id_res'],
                'id_user' => $validatedData['id_user'],
                'date' => $validatedData['date'],
                'commentaire' => $validatedData['commentaire'],
                'id_commentaire_parent' => $validatedData['id_commentaire_parent'],
                'id_etat' => 1,
            ]);
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
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

    public function update(UpdateLienRessourceCommentaireRequest $updateLienRessourceCommentaireRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $updateLienRessourceCommentaireRequest->validated();
            $item = LienRessourceCommentaire::where('deleted', 0)->findOrFail($validatedId);
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
            $validatedId = $this->defaultService->checkIdType($id);
            LienRessourceCommentaire::where('deleted', 0)->findOrFail($validatedId)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/liensRessourceCommentaire/update-etat/{id}",
     *     summary="Modifier l'état d'un commentaire",
     *     tags={"LienRessourceCommentaire"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_etat"},
     *             @OA\Property(property="id_etat",  type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function updateEtat(UpdateEtatLienRessourceCommentaireRequest $updateEtatLienRessourceCommentaireRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $updateEtatLienRessourceCommentaireRequest->validated();
            $item = LienRessourceCommentaire::where('deleted', 0)->findOrFail($validatedId);
            $item->update($validatedData);
            return $this->handleService->handleSuccessUpdate($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorUpdate($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

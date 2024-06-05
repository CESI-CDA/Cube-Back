<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPhotoProfilRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\TypageIndexRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\WelcomeUserMail;
use App\Models\LienRessourceUserArchive;
use App\Models\LienRessourceUserFavoris;
use App\Models\User;
use App\Services\DefaultService;
use App\Services\HandleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService,
        protected UserService $userService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Récupérer toutes les utilisateurs",
     *     tags={"Users"},
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
            $queryModel = User::query()->where('deleted', 0);
            $items = $this->defaultService->dataIndexBasique($typageIndexRequest, $queryModel, ['nom', 'prenom', 'pseudonyme', 'email', 'id_rol'], ['getLienUserRestriction']);
            foreach ($items as $item) {
                $item->is_restricted = $this->userService->isActiveRestriction($item->id);
            }
            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Récupérer un utilisateur spécifique",
     *     tags={"Users"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Item not found"),
     *     * )
     */

    public function show($id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $user = User::where('deleted', false)->findOrFail($validatedId);
            $getNombreFavoris = LienRessourceUserFavoris::where('id_user', $validatedId)->where('deleted', 0)->count();
            $getNombreArchive = LienRessourceUserArchive::where('id_user', $validatedId)->where('deleted', 0)->count();
            $item = array('user' => $user, 'getNombreFavoris' => $getNombreFavoris, 'getNombreArchive' => $getNombreArchive);
            return $this->handleService->handleSuccessShow($item);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Ajouter un utilisateur",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "pseudonyme", "email", "password", "id_rol"},
     *                 @OA\Property(property="nom", type="string", maxLength=30),
     *                 @OA\Property(property="prenom", type="string", maxLength=30),
     *                 @OA\Property(property="pseudonyme", type="string", maxLength=30),
     *                 @OA\Property(property="email", type="string", maxLength=100),
     *                 @OA\Property(property="id_rol", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function store(StoreUserRequest $storeUserRequest)
    {
        try {
            $randomPassword = Str::random(12);
            $validatedData = $storeUserRequest->validated();
            $item = User::create([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'pseudonyme' => $validatedData['pseudonyme'],
                'email' => $validatedData['email'],
                'id_rol' => $validatedData['id_rol'],
                'password' => Hash::make($randomPassword),
            ]);
            $infos = [
                'password' => $randomPassword,
                'url' => env('FRONTEND_URL') . '/login'
            ];
            Mail::to($item->email)->send(new WelcomeUserMail($infos));
            return $this->handleService->handleSuccessStore($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorStore($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Modifier un utilisateur",
     *     tags={"Users"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "pseudonyme", "email", "password", "id_rol"},
     *             @OA\Property(property="nom",  type="string", maxLength=30),
     *             @OA\Property(property="prenom",  type="string", maxLength=30),
     *             @OA\Property(property="pseudonyme",  type="string", maxLength=30),
     *             @OA\Property(property="email",  type="string", maxLength=100),
     *             @OA\Property(property="id_rol", type="integer"),
     *         )
     *     ),
     *     @OA\Response(response=200, description="Item updated successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */

    public function update(Request $request, UpdateUserRequest $updateUserRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $request->validate([
                'pseudonyme' => 'nullable|string|max:30|unique:users,pseudonyme,' . $validatedId,
                'email' => 'nullable|email|max:255|unique:users,email,' . $validatedId,
            ]);
            $validatedData = $updateUserRequest->validated();
            $item = User::where('deleted', 0)->findOrFail($validatedId);
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
     *     path="/api/users/{id}",
     *     summary="Supprimer un utilisateur",
     *     tags={"Users"},
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
            User::where('deleted', 0)->findOrFail($validatedId)->update(['deleted' => true]);
            return $this->handleService->handleSuccessDestroy();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->handleService->handleErrorDestroy($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/users/storePhotoProfil/{id}",
     *     summary="Ajouter une photo de profil",
     *     tags={"Users"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID of the item"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="photo_profil",
     *                     type="string",
     *                     format="binary",
     *                     description="Fichier de photo de profil"
     *                 ),
     *                 required={"photo_profil"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Création réussie de l'élément"),
     *     @OA\Response(response=422, description="Erreur de validation"),
     *     @OA\Response(response=500, description="Erreur interne du serveur"),
     * )
     */

    public function storePhotoProfil(StoreUserPhotoProfilRequest $storeUserPhotoProfilRequest, $id)
    {
        try {
            $validatedId = $this->defaultService->checkIdType($id);
            $validatedData = $storeUserPhotoProfilRequest->validated();
            $item = User::where('deleted', 0)->findOrFail($validatedId);
            $timestamp = date('d-m-Y_H-i-s');
            $chemin = 'photo_profils/' . $item->id . '/';
            $nom = $timestamp . '.' . $validatedData['photo_profil']->extension();

            if ($item->photo_profil) {
                $ancienNomFichier = basename($item->photo_profil);

                if (File::exists(public_path($chemin . $ancienNomFichier))) {
                    File::move(public_path($chemin . $ancienNomFichier), public_path($chemin . 'old_' . $ancienNomFichier));
                }
            }

            $validatedData['photo_profil']->move(public_path($chemin), $nom);

            $item->update([
                'photo_profil' => $chemin . $nom,
            ]);
            return $this->handleService->handleSuccessUpdate($item);
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleService->handleErrorUpdate($e);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

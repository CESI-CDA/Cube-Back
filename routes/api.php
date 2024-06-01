<?php

use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\EtatCommentaireController;
use App\Http\Controllers\Api\LienRessourceCommentaireController;
use App\Http\Controllers\Api\LienRessourceUserArchiveController;
use App\Http\Controllers\Api\LienRessourceUserFavorisController;
use App\Http\Controllers\Api\LienUserRestrictionController;
use App\Http\Controllers\Api\RelationController;
use App\Http\Controllers\Api\RessourceController;
use App\Http\Controllers\Api\TypeRessourceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VisibiliteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //---------------------------Ressources----------------------------//
    Route::get('/liensRessourceUserFavoris/favorisFromUser/{id_user}', [LienRessourceUserFavorisController::class, 'favorisFromUser']);
    Route::delete('/liensRessourceUserFavoris/{id_res}/{id_user}', [LienRessourceUserFavorisController::class, 'destroy']);
    Route::get('/liensRessourceUserFavoris/{id_res}/{id_user}', [LienRessourceUserFavorisController::class, 'show']);
    Route::apiResource('liensRessourceUserFavoris', LienRessourceUserFavorisController::class);
    Route::get('/ressources/ressourcesCreeFromUtilisateur/{id_user}', [RessourceController::class, 'ressourcesCreeFromUtilisateur']);
    Route::get('/liensRessourceUserArchive/archivesFromUser/{id_user}', [LienRessourceUserArchiveController::class, 'archivesFromUser']);
    Route::delete('/liensRessourceUserArchive/{id_res}/{id_user}', [LienRessourceUserArchiveController::class, 'destroy']);
    Route::get('/liensRessourceUserArchive/{id_res}/{id_user}', [LienRessourceUserArchiveController::class, 'show']);
    Route::apiResource('liensRessourceUserArchive', LienRessourceUserArchiveController::class);
    Route::apiResource('liensRessourceCommentaire', LienRessourceCommentaireController::class);
    Route::put('/liensRessourceCommentaire/update-etat/{id}', [LienRessourceCommentaireController::class, 'updateEtat']);

    //---------------------------Users----------------------------//
    Route::apiResource('users', UserController::class);
    Route::post('/users/storePhotoProfil/{id}', [UserController::class, 'storePhotoProfil']);
    Route::apiResource('liens-user-restriction', LienUserRestrictionController::class);

    //---------------------------Commun----------------------------//
    Route::apiResource('categories', CategorieController::class);
    Route::apiResource('relations', RelationController::class);
    Route::apiResource('typesRessource', TypeRessourceController::class);
    Route::apiResource('visibilites', VisibiliteController::class);
    Route::apiResource('etat-commentaire', EtatCommentaireController::class);

});

Route::apiResource('ressources', RessourceController::class);

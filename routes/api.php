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
    Route::get('categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
    Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::put('categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    Route::get('relations/{id}', [RelationController::class, 'show'])->name('relations.show');
    Route::post('relations', [RelationController::class, 'store'])->name('relations.store');
    Route::put('relations/{id}', [RelationController::class, 'update'])->name('relations.update');
    Route::delete('relations/{id}', [RelationController::class, 'destroy'])->name('relations.destroy');

    Route::get('typesRessource/{id}', [TypeRessourceController::class, 'show'])->name('typesRessource.show');
    Route::post('typesRessource', [TypeRessourceController::class, 'store'])->name('typesRessource.store');
    Route::put('typesRessource/{id}', [TypeRessourceController::class, 'update'])->name('typesRessource.update');
    Route::delete('typesRessource/{id}', [TypeRessourceController::class, 'destroy'])->name('typesRessource.destroy');

    Route::get('visibilites/{id}', [VisibiliteController::class, 'show'])->name('visibilites.show');
    Route::post('visibilites', [VisibiliteController::class, 'store'])->name('visibilites.store');
    Route::put('visibilites/{id}', [VisibiliteController::class, 'update'])->name('visibilites.update');
    Route::delete('visibilites/{id}', [VisibiliteController::class, 'destroy'])->name('visibilites.destroy');

    Route::get('etat-commentaire/{id}', [EtatCommentaireController::class, 'show'])->name('etat-commentaire.show');
    Route::post('etat-commentaire', [EtatCommentaireController::class, 'store'])->name('etat-commentaire.store');
    Route::put('etat-commentaire/{id}', [EtatCommentaireController::class, 'update'])->name('etat-commentaire.update');
    Route::delete('etat-commentaire/{id}', [EtatCommentaireController::class, 'destroy'])->name('etat-commentaire.destroy');
});

Route::apiResource('ressources', RessourceController::class);

Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('relations', [RelationController::class, 'index'])->name('relations.index');
Route::get('typesRessource', [TypeRessourceController::class, 'index'])->name('typesRessource.index');
Route::get('visibilites', [VisibiliteController::class, 'index'])->name('visibilites.index');
Route::get('etat-commentaire', [EtatCommentaireController::class, 'index'])->name('etat-commentaire.index');

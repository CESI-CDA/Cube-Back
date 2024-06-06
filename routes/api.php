<?php

use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\EtatController;
use App\Http\Controllers\Api\LienRessourceCommentaireController;
use App\Http\Controllers\Api\LienRessourceUserArchiveController;
use App\Http\Controllers\Api\LienRessourceUserFavorisController;
use App\Http\Controllers\Api\LienUserRestrictionController;
use App\Http\Controllers\Api\RelationController;
use App\Http\Controllers\Api\RessourceController;
use App\Http\Controllers\Api\StatistiqueController;
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

//---------------------------Nécessite d'être connecté----------------------------//
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //---------------------------Ressources----------------------------//
    Route::post('ressources', [RessourceController::class, 'store'])->name('ressources.store');
    Route::put('ressources/{id}', [RessourceController::class, 'update'])->name('ressources.update');
    Route::delete('ressources/{id}', [RessourceController::class, 'destroy'])->name('ressources.destroy');
    Route::put('/ressources/validate-ressource/{id}', [RessourceController::class, 'validateRessource']);
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

    //---------------------------Catégories----------------------------//
    Route::get('categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
    Route::post('categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::put('categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    //---------------------------Relations----------------------------//
    Route::get('relations/{id}', [RelationController::class, 'show'])->name('relations.show');
    Route::post('relations', [RelationController::class, 'store'])->name('relations.store');
    Route::put('relations/{id}', [RelationController::class, 'update'])->name('relations.update');
    Route::delete('relations/{id}', [RelationController::class, 'destroy'])->name('relations.destroy');

    //---------------------------Types de ressources----------------------------//
    Route::get('typesRessource/{id}', [TypeRessourceController::class, 'show'])->name('typesRessource.show');
    Route::post('typesRessource', [TypeRessourceController::class, 'store'])->name('typesRessource.store');
    Route::put('typesRessource/{id}', [TypeRessourceController::class, 'update'])->name('typesRessource.update');
    Route::delete('typesRessource/{id}', [TypeRessourceController::class, 'destroy'])->name('typesRessource.destroy');

    //---------------------------Visibilités----------------------------//
    Route::get('visibilites/{id}', [VisibiliteController::class, 'show'])->name('visibilites.show');
    Route::post('visibilites', [VisibiliteController::class, 'store'])->name('visibilites.store');
    Route::put('visibilites/{id}', [VisibiliteController::class, 'update'])->name('visibilites.update');
    Route::delete('visibilites/{id}', [VisibiliteController::class, 'destroy'])->name('visibilites.destroy');

    //---------------------------Etats----------------------------//
    Route::get('etat/{id}', [EtatController::class, 'show'])->name('etat.show');
    Route::post('etat', [EtatController::class, 'store'])->name('etat.store');
    Route::put('etat/{id}', [EtatController::class, 'update'])->name('etat.update');
    Route::delete('etat/{id}', [EtatController::class, 'destroy'])->name('etat.destroy');

    //---------------------------Statistiques----------------------------//
    Route::get('statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
});

//---------------------------Accessible en invité----------------------------//
Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('relations', [RelationController::class, 'index'])->name('relations.index');
Route::get('typesRessource', [TypeRessourceController::class, 'index'])->name('typesRessource.index');
Route::get('visibilites', [VisibiliteController::class, 'index'])->name('visibilites.index');
Route::get('etat', [EtatController::class, 'index'])->name('etat.index');
Route::get('ressources', [RessourceController::class, 'index'])->name('ressources.index');
Route::get('ressources/{id}', [RessourceController::class, 'show'])->name('ressources.show');

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

    //---------------------------Nécisitte d'etre admin ou super-admin----------------------------//
    Route::middleware(['checkPermissionNeeded:1,2,3'])->group(function () {
        Route::put('/ressources/validate-ressource/{id}', [RessourceController::class, 'validateRessource']);
        Route::put('/liensRessourceCommentaire/update-etat/{id}', [LienRessourceCommentaireController::class, 'updateEtat']);
        Route::apiResource('liens-user-restriction', LienUserRestrictionController::class);
        Route::get('statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
    });

    //---------------------------Ressources----------------------------//
    Route::post('ressources', [RessourceController::class, 'store'])->name('ressources.store');
    Route::put('ressources/{id}', [RessourceController::class, 'update'])->name('ressources.update'); //TODO: uniquement ses ressources
    Route::delete('ressources/{id}', [RessourceController::class, 'destroy'])->name('ressources.destroy'); //TODO: uniquement ses ressources

    Route::get('/liensRessourceUserFavoris/favorisFromUser/{id_user}', [LienRessourceUserFavorisController::class, 'favorisFromUser']); //TODO: uniquement ses favoris
    Route::delete('/liensRessourceUserFavoris/{id_res}/{id_user}', [LienRessourceUserFavorisController::class, 'destroy']); //TODO: uniquement ses favoris
    Route::get('/liensRessourceUserFavoris/{id_res}/{id_user}', [LienRessourceUserFavorisController::class, 'show']);
    Route::get('/ressources/ressourcesCreeFromUtilisateur/{id_user}', [RessourceController::class, 'ressourcesCreeFromUtilisateur']);
    Route::get('/liensRessourceUserArchive/archivesFromUser/{id_user}', [LienRessourceUserArchiveController::class, 'archivesFromUser']);
    Route::delete('/liensRessourceUserArchive/{id_res}/{id_user}', [LienRessourceUserArchiveController::class, 'destroy']);
    Route::get('/liensRessourceUserArchive/{id_res}/{id_user}', [LienRessourceUserArchiveController::class, 'show']);


    Route::get('liensRessourceUserFavoris', [LienRessourceUserFavorisController::class, 'index'])->name('liensRessourceUserFavoris.index');
    Route::get('liensRessourceUserFavoris/{id}', [LienRessourceUserFavorisController::class, 'show'])->name('liensRessourceUserFavoris.show');
    Route::post('liensRessourceUserFavoris', [LienRessourceUserFavorisController::class, 'store'])->name('liensRessourceUserFavoris.store');
    Route::put('liensRessourceUserFavoris/{id}', [LienRessourceUserFavorisController::class, 'update'])->name('liensRessourceUserFavoris.update');
    Route::delete('liensRessourceUserFavoris/{id}', [LienRessourceUserFavorisController::class, 'destroy'])->name('liensRessourceUserFavoris.destroy');

    Route::get('liensRessourceUserArchive', [LienRessourceUserArchiveController::class, 'index'])->name('liensRessourceUserArchive.index');
    Route::get('liensRessourceUserArchive/{id}', [LienRessourceUserArchiveController::class, 'show'])->name('liensRessourceUserArchive.show');
    Route::post('liensRessourceUserArchive', [LienRessourceUserArchiveController::class, 'store'])->name('liensRessourceUserArchive.store');
    Route::put('liensRessourceUserArchive/{id}', [LienRessourceUserArchiveController::class, 'update'])->name('liensRessourceUserArchive.update');
    Route::delete('liensRessourceUserArchive/{id}', [LienRessourceUserArchiveController::class, 'destroy'])->name('liensRessourceUserArchive.destroy');

    Route::get('liensRessourceCommentaire', [LienRessourceCommentaireController::class, 'index'])->name('liensRessourceCommentaire.index');
    Route::get('liensRessourceCommentaire/{id}', [LienRessourceCommentaireController::class, 'show'])->name('liensRessourceCommentaire.show');
    Route::post('liensRessourceCommentaire', [LienRessourceCommentaireController::class, 'store'])->name('liensRessourceCommentaire.store');
    Route::put('liensRessourceCommentaire/{id}', [LienRessourceCommentaireController::class, 'update'])->name('liensRessourceCommentaire.update');
    Route::delete('liensRessourceCommentaire/{id}', [LienRessourceCommentaireController::class, 'destroy'])->name('liensRessourceCommentaire.destroy');

    //---------------------------Users----------------------------//
    Route::apiResource('users', UserController::class);
    Route::post('/users/storePhotoProfil/{id}', [UserController::class, 'storePhotoProfil']);

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
});

//---------------------------Accessible en invité----------------------------//
Route::get('categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('relations', [RelationController::class, 'index'])->name('relations.index');
Route::get('typesRessource', [TypeRessourceController::class, 'index'])->name('typesRessource.index');
Route::get('visibilites', [VisibiliteController::class, 'index'])->name('visibilites.index');
Route::get('etat', [EtatController::class, 'index'])->name('etat.index');
Route::get('ressources', [RessourceController::class, 'index'])->name('ressources.index');
Route::get('ressources/{id}', [RessourceController::class, 'show'])->name('ressources.show');

<?php

use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\LienRessourceUserFavorisController;
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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('ressources', RessourceController::class);

Route::apiResource('users', UserController::class);
Route::post('/users/storePhotoProfil/{id}', [UserController::class, 'storePhotoProfil']);

Route::apiResource('categories', CategorieController::class);

Route::get('/liensRessourceUserFavoris/favorisFromUser/{id_user}', [LienRessourceUserFavorisController::class, 'favorisFromUser']);
Route::delete('/liensRessourceUserFavoris/{id_res}/{id_user}', [LienRessourceUserFavorisController::class, 'destroy']);
Route::apiResource('liensRessourceUserFavoris', LienRessourceUserFavorisController::class);

Route::apiResource('relations', RelationController::class);

Route::apiResource('typesRessource', TypeRessourceController::class);

Route::apiResource('visibilites', VisibiliteController::class);

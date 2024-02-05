<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\UpdateRessourceRequest;
use App\Models\Ressource;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->validate([
                'per_page' => 'integer|min:1|max:100'
            ]);

            $query = Ressource::query();

            $ressources = $query->paginate($request->input('per_page', 10));

            return response()->json([
                'status' => true,
                'ressources' => $ressources
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreRessourceRequest $request)
    {
        try {
            $validatedData = $request->validated();
            
            $ressource = Ressource::create($validatedData);

            return response()->json([
                'status' => true,
                'ressource' => $ressource,
                'message' => 'La ressource a été créée avec succès.'
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la création de la ressource.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateRessourceRequest $request, $id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            $validatedData = $request->validated();
            $ressource = Ressource::findOrFail($id);
            $ressource->update($validatedData);

            return response()->json([
                'status' => true,
                'ressource' => $ressource,
                'message' => 'La ressource a été mise à jour avec succès.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'La ressource demandée n\'existe pas.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite lors de la mise à jour.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \InvalidArgumentException('L\'ID doit être un nombre entier positif.');
            }
            $ressource = Ressource::findOrFail($id);
            $ressource->delete();

            return response()->json([
                'status' => true,
                'message' => 'La ressource a été supprimée avec succès.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'La ressource demandée n\'existe pas.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur s\'est produite lors de la suppression.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

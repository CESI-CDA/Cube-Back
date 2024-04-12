<?php

namespace App\Services;

class HandleService
{
    //Gestion du message d'erreur en retour
    public function handleError(\Exception $e)
    {
        return response()->json([
            'status' => false,
            'message' => 'Une erreur s\'est produite.',
            'error' => $e->getMessage(),
        ], 500);
    }
    public function handleErrorStore(\Exception $e)
    {
        return response()->json([
            'status' => false,
            'message' => 'Erreur lors de la création de l\'item',
            'error' => $e->getMessage(),
        ], 500);
    }
    public function handleErrorUpdate(\Exception $e)
    {
        return response()->json([
            'status' => false,
            'message' => 'Erreur lors de l\'edition de l\'item',
            'error' => $e->getMessage(),
        ], 500);
    }
    public function handleErrorDestroy(\Exception $e)
    {
        return response()->json([
            'status' => false,
            'message' => 'Erreur lors de la suppression de l\'item',
            'error' => $e->getMessage(),
        ], 500);
    }
    public function handleSuccessIndex($items)
    {
        return response()->json([
            'status' => true,
            'items' => $items
        ], 200);
    }
    public function handleSuccessShow($item)
    {
        return response()->json([
            'status' => true,
            'item' => $item
        ], 200);
    }
    public function handleSuccessStore($item)
    {
        return response()->json([
            'status' => true,
            'item' => $item,
            'message' => 'L\'item a été créé avec succès.'
        ], 201);
    }
    public function handleSuccessUpdate($item)
    {
        return response()->json([
            'status' => true,
            'item' => $item,
            'message' => 'L\'item a été mis à jour avec succès.'
        ], 201);
    }
    public function handleSuccessDestroy()
    {
        return response()->json([
            'status' => true,
            'message' => 'L\'item a été supprimé avec succès.'
        ], 200);
    }
}

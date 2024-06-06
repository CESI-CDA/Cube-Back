<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use App\Services\DefaultService;
use App\Services\HandleService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(name="Statistique")
 */
class StatistiqueController extends Controller
{
    public function __construct(
        protected DefaultService $defaultService,
        protected HandleService $handleService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/statistiques",
     *     summary="Get all items",
     *     tags={"Statistique"},
     *    @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Keyword for searching items by date (12months or 6months or 7days)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */


    public function index(Request $request)
    {
        try {
            $request->validate([
                'date' => 'string|nullable'
            ]);
            $date = $request->input('date', '7days');
            switch ($date) {
                case '12months':
                    $dateToCompare = new DateTime();
                    $dateToCompare->modify('-12 months');
                    break;
                case '30days':
                    $dateToCompare = new DateTime();
                    $dateToCompare->modify('-30 days');
                    break;
                case '7days':
                    $dateToCompare = new DateTime();
                    $dateToCompare->modify('-7 days');
                    break;
                default:
                    $dateToCompare = new DateTime();
                    $dateToCompare->modify('-7 days');
                    break;
            }
            $query = Ressource::query()
                ->where('ressource.deleted', false)
                ->where('date_creation', '>=', $dateToCompare)
                ->leftJoin('lien_ressource_categorie', function ($join) {
                    $join->on('ressource.id', '=', 'lien_ressource_categorie.id_res')
                        ->where('lien_ressource_categorie.deleted', false);
                })
                ->leftJoin('lien_ressource_commentaire', function ($join) {
                    $join->on('ressource.id', '=', 'lien_ressource_commentaire.id_res')
                        ->where('lien_ressource_commentaire.deleted', false);
                })
                ->leftJoin('lien_ressource_relation', function ($join) {
                    $join->on('ressource.id', '=', 'lien_ressource_relation.id_res')
                        ->where('lien_ressource_relation.deleted', false);
                })
                ->leftJoin('lien_ressource_user_archive', function ($join) {
                    $join->on('ressource.id', '=', 'lien_ressource_user_archive.id_res')
                        ->where('lien_ressource_user_archive.deleted', false);
                })
                ->leftJoin('lien_ressource_user_favoris', function ($join) {
                    $join->on('ressource.id', '=', 'lien_ressource_user_favoris.id_res')
                        ->where('lien_ressource_user_favoris.deleted', false);
                });

            $query->select(
                DB::raw('COUNT(DISTINCT ressource.id) as nombre_ressources_crees'),
                DB::raw('SUM(ressource.id_type_res = 1) as nombre_ressources_type_1'),
                DB::raw('SUM(ressource.id_type_res = 2) as nombre_ressources_type_2'),
                DB::raw('SUM(ressource.id_type_res = 3) as nombre_ressources_type_3'),
                DB::raw('SUM(ressource.id_vis = 1) as nombre_ressources_visibilite_1'),
                DB::raw('SUM(ressource.id_vis = 2) as nombre_ressources_visibilite_2'),
                DB::raw('SUM(ressource.is_archive = 0) as nombre_ressources_non_archive'),
                DB::raw('SUM(ressource.is_archive = 1) as nombre_ressources_archive'),
                DB::raw('SUM(ressource.id_etat = 1) as nombre_ressources_etat_1'),
                DB::raw('SUM(ressource.id_etat = 2) as nombre_ressources_etat_2'),
                DB::raw('SUM(ressource.id_etat = 3) as nombre_ressources_etat_3'),
                DB::raw('SUM(lien_ressource_relation.id_rel = 1) as nombre_ressources_relation_1'),
                DB::raw('SUM(lien_ressource_relation.id_rel = 2) as nombre_ressources_relation_2'),
                DB::raw('SUM(lien_ressource_categorie.id_cat = 1) as nombre_ressources_categorie_1'),
                DB::raw('SUM(lien_ressource_categorie.id_cat = 2) as nombre_ressources_categorie_2'),
                DB::raw('SUM(lien_ressource_categorie.id_cat = 3) as nombre_ressources_categorie_3'),
                DB::raw('SUM(lien_ressource_categorie.id_cat = 4) as nombre_ressources_categorie_4'),
                DB::raw('SUM(lien_ressource_categorie.id_cat = 5) as nombre_ressources_categorie_5'),
                DB::raw('SUM(lien_ressource_categorie.id_cat = 6) as nombre_ressources_categorie_6'),
                DB::raw('SUM(lien_ressource_categorie.id_cat = 7) as nombre_ressources_categorie_7'),
                DB::raw('COUNT(DISTINCT lien_ressource_user_archive.id_res, lien_ressource_user_archive.id_user) as nombres_archives'),
                DB::raw('COUNT(DISTINCT lien_ressource_user_favoris.id_res, lien_ressource_user_favoris.id_user) as nombres_favoris'),
            );

            $items = $query->get();

            $items = $items->map(function ($item) {
                return array_map('intval', $item->toArray());
            });

            return $this->handleService->handleSuccessIndex($items);
        } catch (\Exception $e) {
            return $this->handleService->handleError($e);
        }
    }
}

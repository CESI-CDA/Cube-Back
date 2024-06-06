<?php

namespace Database\Seeders;

use App\Models\LienRessourceUserFavoris;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class LienRessourceUserFavorisSeeder extends Seeder
{
    /**
     * The TruncateTableService instance.
     *
     * @var TruncateTableService
     */
    private $truncateTableService;

    /**
     * Constructor.
     *
     * @param TruncateTableService $truncateTableService
     */
    public function __construct(TruncateTableService $truncateTableService)
    {
        $this->truncateTableService = $truncateTableService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateTableService->truncateTable('lien_ressource_user_favoris');
        $lienRessourceUserFavorisData = [
            ['id_res' => 1, 'id_user' => 1],
            ['id_res' => 2, 'id_user' => 2],
            ['id_res' => 3, 'id_user' => 3],
            ['id_res' => 4, 'id_user' => 4],
            ['id_res' => 5, 'id_user' => 5],
            ['id_res' => 6, 'id_user' => 6],
            ['id_res' => 7, 'id_user' => 7],
            ['id_res' => 8, 'id_user' => 8],
            ['id_res' => 9, 'id_user' => 9],
            ['id_res' => 10, 'id_user' => 10],
            ['id_res' => 11, 'id_user' => 1],
            ['id_res' => 12, 'id_user' => 2],
            ['id_res' => 13, 'id_user' => 3],
            ['id_res' => 14, 'id_user' => 4],
            ['id_res' => 15, 'id_user' => 5],
            ['id_res' => 16, 'id_user' => 6],
            ['id_res' => 17, 'id_user' => 7],
            ['id_res' => 18, 'id_user' => 8],
            ['id_res' => 19, 'id_user' => 9],
            ['id_res' => 20, 'id_user' => 10]
        ];

        foreach ($lienRessourceUserFavorisData as $lienRessourceUserFavoris) {
            LienRessourceUserFavoris::create([
                'id_res' => $lienRessourceUserFavoris['id_res'],
                'id_user' => $lienRessourceUserFavoris['id_user']
            ]);
        }
    }
}


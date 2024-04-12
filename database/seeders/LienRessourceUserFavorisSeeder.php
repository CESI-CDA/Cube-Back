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
            ['id_res' => 1, 'id_user' => 2],
            ['id_res' => 2, 'id_user' => 2]
        ];

        foreach ($lienRessourceUserFavorisData as $lienRessourceUserFavoris) {
            LienRessourceUserFavoris::create([
                'id_res' => $lienRessourceUserFavoris['id_res'],
                'id_user' => $lienRessourceUserFavoris['id_user']
            ]);
        }
    }
}


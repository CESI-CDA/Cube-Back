<?php

namespace Database\Seeders;

use App\Models\LienRessourceCategorie;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class LienRessourceCategorieSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('lien_ressource_categorie');

        $lienRessourceCategorieData = [
            ['id_res' => 1, 'id_cat' => 1],
            ['id_res' => 2, 'id_cat' => 1],
            ['id_res' => 2, 'id_cat' => 2],
            ['id_res' => 3, 'id_cat' => 2],
            ['id_res' => 3, 'id_cat' => 3],
            ['id_res' => 4, 'id_cat' => 3],
            ['id_res' => 4, 'id_cat' => 4],
            ['id_res' => 5, 'id_cat' => 4],
            ['id_res' => 5, 'id_cat' => 5],
            ['id_res' => 6, 'id_cat' => 5],
            ['id_res' => 6, 'id_cat' => 6],
            ['id_res' => 7, 'id_cat' => 6],
            ['id_res' => 7, 'id_cat' => 7],
            ['id_res' => 8, 'id_cat' => 7],
            ['id_res' => 8, 'id_cat' => 1],
            ['id_res' => 9, 'id_cat' => 1],
            ['id_res' => 9, 'id_cat' => 2],
            ['id_res' => 10, 'id_cat' => 2],
            ['id_res' => 10, 'id_cat' => 3],
            ['id_res' => 11, 'id_cat' => 3],
            ['id_res' => 11, 'id_cat' => 4],
            ['id_res' => 12, 'id_cat' => 4],
            ['id_res' => 12, 'id_cat' => 5],
            ['id_res' => 13, 'id_cat' => 5],
            ['id_res' => 13, 'id_cat' => 6],
            ['id_res' => 14, 'id_cat' => 6],
            ['id_res' => 15, 'id_cat' => 7],
            ['id_res' => 15, 'id_cat' => 1],
            ['id_res' => 16, 'id_cat' => 1],
            ['id_res' => 16, 'id_cat' => 2],
            ['id_res' => 17, 'id_cat' => 2],
            ['id_res' => 17, 'id_cat' => 3],
            ['id_res' => 18, 'id_cat' => 3],
            ['id_res' => 18, 'id_cat' => 4],
            ['id_res' => 19, 'id_cat' => 4],
            ['id_res' => 19, 'id_cat' => 5],
            ['id_res' => 20, 'id_cat' => 5],
            ['id_res' => 20, 'id_cat' => 6],
            ['id_res' => 21, 'id_cat' => 6],
            ['id_res' => 21, 'id_cat' => 7],
            ['id_res' => 22, 'id_cat' => 7],
            ['id_res' => 22, 'id_cat' => 1],
            ['id_res' => 23, 'id_cat' => 1],
            ['id_res' => 23, 'id_cat' => 2],
            ['id_res' => 24, 'id_cat' => 2],
            ['id_res' => 24, 'id_cat' => 3],
            ['id_res' => 25, 'id_cat' => 3],
            ['id_res' => 25, 'id_cat' => 4],
            ['id_res' => 26, 'id_cat' => 4],
            ['id_res' => 26, 'id_cat' => 5],
            ['id_res' => 27, 'id_cat' => 5],
            ['id_res' => 27, 'id_cat' => 6],
            ['id_res' => 28, 'id_cat' => 6],
            ['id_res' => 28, 'id_cat' => 7],
            ['id_res' => 29, 'id_cat' => 7],
            ['id_res' => 29, 'id_cat' => 1],
            ['id_res' => 30, 'id_cat' => 1],
            ['id_res' => 30, 'id_cat' => 2],
            ['id_res' => 31, 'id_cat' => 2],
            ['id_res' => 31, 'id_cat' => 3],
            ['id_res' => 32, 'id_cat' => 3],
            ['id_res' => 32, 'id_cat' => 4],
            ['id_res' => 33, 'id_cat' => 4],
            ['id_res' => 33, 'id_cat' => 5],
            ['id_res' => 34, 'id_cat' => 5],
            ['id_res' => 34, 'id_cat' => 6],
            ['id_res' => 35, 'id_cat' => 6],
            ['id_res' => 35, 'id_cat' => 7],
            ['id_res' => 36, 'id_cat' => 7],
            ['id_res' => 36, 'id_cat' => 1],
            ['id_res' => 37, 'id_cat' => 1],
            ['id_res' => 37, 'id_cat' => 2],
            ['id_res' => 38, 'id_cat' => 2],
            ['id_res' => 38, 'id_cat' => 3],
            ['id_res' => 39, 'id_cat' => 3],
            ['id_res' => 39, 'id_cat' => 4],
            ['id_res' => 40, 'id_cat' => 4],
            ['id_res' => 40, 'id_cat' => 5],
            ['id_res' => 41, 'id_cat' => 5],
            ['id_res' => 41, 'id_cat' => 6],
            ['id_res' => 42, 'id_cat' => 6],
            ['id_res' => 42, 'id_cat' => 7],
            ['id_res' => 43, 'id_cat' => 7],
            ['id_res' => 43, 'id_cat' => 1],
            ['id_res' => 44, 'id_cat' => 1],
            ['id_res' => 44, 'id_cat' => 2],
            ['id_res' => 45, 'id_cat' => 2],
            ['id_res' => 45, 'id_cat' => 3],
            ['id_res' => 46, 'id_cat' => 3],
            ['id_res' => 46, 'id_cat' => 4],
            ['id_res' => 47, 'id_cat' => 4],
            ['id_res' => 47, 'id_cat' => 5],
            ['id_res' => 48, 'id_cat' => 5],
            ['id_res' => 48, 'id_cat' => 6],
            ['id_res' => 49, 'id_cat' => 6],
            ['id_res' => 49, 'id_cat' => 7],
            ['id_res' => 50, 'id_cat' => 7],
            ['id_res' => 50, 'id_cat' => 1],

        ];

        foreach ($lienRessourceCategorieData as $lienRessourceCategorie) {
            LienRessourceCategorie::create([
                'id_res' => $lienRessourceCategorie['id_res'],
                'id_cat' => $lienRessourceCategorie['id_cat']
            ]);
        }
    }
}

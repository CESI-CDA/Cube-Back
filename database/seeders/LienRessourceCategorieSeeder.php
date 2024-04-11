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
            ['id_res' => 2, 'id_cat' => 2]
        ];

        foreach ($lienRessourceCategorieData as $lienRessourceCategorie) {
            LienRessourceCategorie::create([
                'id_res' => $lienRessourceCategorie['id_res'],
                'id_cat' => $lienRessourceCategorie['id_cat']
            ]);
        }
    }
}


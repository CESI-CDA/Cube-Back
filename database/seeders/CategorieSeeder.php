<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('categorie');

        $categorieData = [
            ['id' => 1, 'intitule_cat' => 'Communication'],
            ['id' => 2, 'intitule_cat' => 'Culture'],
            ['id' => 3, 'intitule_cat' => 'Sport'],
            ['id' => 4, 'intitule_cat' => 'Technologie'],
            ['id' => 5, 'intitule_cat' => 'Finance'],
            ['id' => 6, 'intitule_cat' => 'Éducation'],
            ['id' => 7, 'intitule_cat' => 'Santé'],
        ];

        foreach ($categorieData as $categorie) {
            Categorie::create([
                'id' => $categorie['id'],
                'intitule_cat' => $categorie['intitule_cat']
            ]);
        }
    }
}

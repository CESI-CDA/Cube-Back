<?php

namespace Database\Seeders;

use App\Models\LienRessourceRelation;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class LienRessourceRelationSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('lien_ressource_relation');
        $lienRessourceRelationData = [
            ['id_res' => 1, 'id_rel' => 1],
            ['id_res' => 2, 'id_rel' => 1],
            ['id_res' => 2, 'id_rel' => 2],
            ['id_res' => 3, 'id_rel' => 2],
            ['id_res' => 3, 'id_rel' => 1],
            ['id_res' => 4, 'id_rel' => 1],
            ['id_res' => 4, 'id_rel' => 2],
            ['id_res' => 5, 'id_rel' => 2],
            ['id_res' => 5, 'id_rel' => 1],
            ['id_res' => 6, 'id_rel' => 1],
            ['id_res' => 6, 'id_rel' => 2],
            ['id_res' => 7, 'id_rel' => 2],
            ['id_res' => 7, 'id_rel' => 1],
            ['id_res' => 8, 'id_rel' => 1],
            ['id_res' => 8, 'id_rel' => 2],
            ['id_res' => 9, 'id_rel' => 2],
            ['id_res' => 9, 'id_rel' => 1],
            ['id_res' => 10, 'id_rel' => 1],
            ['id_res' => 10, 'id_rel' => 2],
            ['id_res' => 11, 'id_rel' => 2],
            ['id_res' => 11, 'id_rel' => 1],
            ['id_res' => 12, 'id_rel' => 1],
            ['id_res' => 12, 'id_rel' => 2],
            ['id_res' => 13, 'id_rel' => 2],
            ['id_res' => 13, 'id_rel' => 1],
            ['id_res' => 14, 'id_rel' => 1],
            ['id_res' => 14, 'id_rel' => 2],
            ['id_res' => 15, 'id_rel' => 2],
            ['id_res' => 15, 'id_rel' => 1],
            ['id_res' => 16, 'id_rel' => 1],
            ['id_res' => 16, 'id_rel' => 2],
            ['id_res' => 17, 'id_rel' => 2],
            ['id_res' => 17, 'id_rel' => 1],
            ['id_res' => 18, 'id_rel' => 1],
            ['id_res' => 18, 'id_rel' => 2],
            ['id_res' => 19, 'id_rel' => 2],
            ['id_res' => 19, 'id_rel' => 1],
            ['id_res' => 20, 'id_rel' => 1],
            ['id_res' => 20, 'id_rel' => 2],
            ['id_res' => 21, 'id_rel' => 2],
            ['id_res' => 21, 'id_rel' => 1],
            ['id_res' => 22, 'id_rel' => 1],
            ['id_res' => 22, 'id_rel' => 2],
            ['id_res' => 23, 'id_rel' => 2],
            ['id_res' => 23, 'id_rel' => 1],
            ['id_res' => 24, 'id_rel' => 1],
            ['id_res' => 24, 'id_rel' => 2],
            ['id_res' => 25, 'id_rel' => 2],
            ['id_res' => 25, 'id_rel' => 1],
            ['id_res' => 26, 'id_rel' => 1],
            ['id_res' => 26, 'id_rel' => 2],
            ['id_res' => 27, 'id_rel' => 2],
            ['id_res' => 27, 'id_rel' => 1],
            ['id_res' => 28, 'id_rel' => 1],
            ['id_res' => 28, 'id_rel' => 2],
            ['id_res' => 29, 'id_rel' => 2],
            ['id_res' => 29, 'id_rel' => 1],
            ['id_res' => 30, 'id_rel' => 1],
            ['id_res' => 30, 'id_rel' => 2],
            ['id_res' => 31, 'id_rel' => 2],
            ['id_res' => 31, 'id_rel' => 1],
            ['id_res' => 32, 'id_rel' => 1],
            ['id_res' => 32, 'id_rel' => 2],
            ['id_res' => 33, 'id_rel' => 2],
            ['id_res' => 33, 'id_rel' => 1],
            ['id_res' => 34, 'id_rel' => 1],
            ['id_res' => 34, 'id_rel' => 2],
            ['id_res' => 35, 'id_rel' => 2],
            ['id_res' => 35, 'id_rel' => 1],
            ['id_res' => 36, 'id_rel' => 1],
            ['id_res' => 36, 'id_rel' => 2],
            ['id_res' => 37, 'id_rel' => 2],
            ['id_res' => 37, 'id_rel' => 1],
            ['id_res' => 38, 'id_rel' => 1],
            ['id_res' => 38, 'id_rel' => 2],
            ['id_res' => 39, 'id_rel' => 2],
            ['id_res' => 39, 'id_rel' => 1],
            ['id_res' => 40, 'id_rel' => 1],
            ['id_res' => 40, 'id_rel' => 2],
            ['id_res' => 41, 'id_rel' => 2],
            ['id_res' => 41, 'id_rel' => 1],
            ['id_res' => 42, 'id_rel' => 1],
            ['id_res' => 42, 'id_rel' => 2],
            ['id_res' => 43, 'id_rel' => 2],
            ['id_res' => 43, 'id_rel' => 1],
            ['id_res' => 44, 'id_rel' => 1],
            ['id_res' => 44, 'id_rel' => 2],
            ['id_res' => 45, 'id_rel' => 2],
            ['id_res' => 45, 'id_rel' => 1],
            ['id_res' => 46, 'id_rel' => 1],
            ['id_res' => 46, 'id_rel' => 2],
            ['id_res' => 47, 'id_rel' => 2],
            ['id_res' => 47, 'id_rel' => 1],
            ['id_res' => 48, 'id_rel' => 1],
            ['id_res' => 48, 'id_rel' => 2],
            ['id_res' => 49, 'id_rel' => 2],
            ['id_res' => 49, 'id_rel' => 1],
            ['id_res' => 50, 'id_rel' => 1],
            ['id_res' => 50, 'id_rel' => 2],

        ];

        foreach ($lienRessourceRelationData as $lienRessourceRelation) {
            LienRessourceRelation::create([
                'id_res' => $lienRessourceRelation['id_res'],
                'id_rel' => $lienRessourceRelation['id_rel']
            ]);
        }
    }
}

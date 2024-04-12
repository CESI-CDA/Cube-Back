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
            ['id_res' => 1, 'id_rel' => 2],
            ['id_res' => 2, 'id_rel' => 2]
        ];

        foreach ($lienRessourceRelationData as $lienRessourceRelation) {
            LienRessourceRelation::create([
                'id_res' => $lienRessourceRelation['id_res'],
                'id_rel' => $lienRessourceRelation['id_rel']
            ]);
        }
    }
}


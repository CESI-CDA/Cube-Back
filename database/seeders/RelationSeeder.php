<?php

namespace Database\Seeders;

use App\Models\Relation;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('relation');
        $lienRessourceUserEtatData = [
            ['id' => 1, 'intitule_rel' => 'Famille'],
            ['id' => 2, 'intitule_rel' => 'Ami']
        ];

        foreach ($lienRessourceUserEtatData as $lienRessourceUserEtat) {
            Relation::create([
                'id' => $lienRessourceUserEtat['id'],
                'intitule_rel' => $lienRessourceUserEtat['intitule_rel']
            ]);
        }
    }
}


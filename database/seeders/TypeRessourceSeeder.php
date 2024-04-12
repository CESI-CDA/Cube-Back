<?php

namespace Database\Seeders;

use App\Models\TypeRessource;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class TypeRessourceSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('type_ressource');
        $typeRessourceData = [
            ['id' => 1, 'intitule_type_res' => 'News'],
            ['id' => 2, 'intitule_type_res' => 'Exercice / Atelier'],
            ['id' => 3, 'intitule_type_res' => 'Documentaire']
        ];

        foreach ($typeRessourceData as $typeRessource) {
            TypeRessource::create([
                'id' => $typeRessource['id'],
                'intitule_type_res' => $typeRessource['intitule_type_res']
            ]);
        }
    }
}



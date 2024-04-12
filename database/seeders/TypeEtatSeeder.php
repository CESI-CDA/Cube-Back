<?php

namespace Database\Seeders;

use App\Models\TypeEtat;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class TypeEtatSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('type_etat');
        $typeEtatData = [
            ['id' => 1, 'intitule_type_eta' => 'En lecture'],
            ['id' => 2, 'intitule_type_eta' => 'Lu']
        ];

        foreach ($typeEtatData as $typeEtat) {
            TypeEtat::create([
                'id' => $typeEtat['id'],
                'intitule_type_eta' => $typeEtat['intitule_type_eta']
            ]);
        }
    }
}



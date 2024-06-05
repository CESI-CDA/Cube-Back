<?php

namespace Database\Seeders;

use App\Models\Etat;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class EtatSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('etat');
        $etatData = [
            ['id' => 1, 'intitule' => 'En attente'],
            ['id' => 2, 'intitule' => 'Validé'],
            ['id' => 3, 'intitule' => 'Refusé']
        ];

        foreach ($etatData as $etat) {
            Etat::create([
                'id' => $etat['id'],
                'intitule' => $etat['intitule']
            ]);
        }
    }
}

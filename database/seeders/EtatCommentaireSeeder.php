<?php

namespace Database\Seeders;

use App\Models\EtatCommentaire;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class EtatCommentaireSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('etat_commentaire');
        $etatCommentaireData = [
            ['id' => 1, 'intitule' => 'En attente'],
            ['id' => 2, 'intitule' => 'Validé'],
            ['id' => 3, 'intitule' => 'Refusé']
        ];

        foreach ($etatCommentaireData as $etatCommentaire) {
            EtatCommentaire::create([
                'id' => $etatCommentaire['id'],
                'intitule' => $etatCommentaire['intitule']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\LienRessourceCommentaire;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class LienRessourceCommentaireSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('lien_ressource_commentaire');
        $lienRessourceCommentaireData = [
            ['id' => 1, 'id_res' => 1, 'id_user' => 1, 'date' => now(), 'commentaire' => 'Voici un commentaire', 'id_commentaire_parent' => null],
            ['id' => 2, 'id_res' => 1, 'id_user' => 2, 'date' => now(), 'commentaire' => 'Voici un sous-commentaire', 'id_commentaire_parent' => 1],
            ['id' => 3, 'id_res' => 2, 'id_user' => 2, 'date' => now(), 'commentaire' => 'Voici un commentaire', 'id_commentaire_parent' => null]
        ];

        foreach ($lienRessourceCommentaireData as $lienRessourceCommentaire) {
            LienRessourceCommentaire::create([
                'id' => $lienRessourceCommentaire['id'],
                'id_res' => $lienRessourceCommentaire['id_res'],
                'id_user' => $lienRessourceCommentaire['id_user'],
                'date' => $lienRessourceCommentaire['date'],
                'commentaire' => $lienRessourceCommentaire['commentaire'],
                'id_commentaire_parent' => $lienRessourceCommentaire['id_commentaire_parent']
            ]);
        }
    }
}


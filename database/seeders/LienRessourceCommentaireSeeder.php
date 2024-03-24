<?php

namespace Database\Seeders;

use App\Models\LienRessourceCommentaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LienRessourceCommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liensRessourceCommentaire = [[1, 1, 1, now(), 'Voici un commentaire', null], [2, 1, 2, now(), 'Voici un sous-commentaire', 1], [3, 2, 2, now(), 'Voici un commentaire', null]];

        foreach ($liensRessourceCommentaire as $lienRessourceCommentaire)
        {
            LienRessourceCommentaire::create([
                'id' => $lienRessourceCommentaire[0],
                'id_res' => $lienRessourceCommentaire[1],
                'id_user' => $lienRessourceCommentaire[2],
                'date' => $lienRessourceCommentaire[3],
                'commentaire' => $lienRessourceCommentaire[4],
                'id_commentaire_parent' => $lienRessourceCommentaire[5]
            ]);

        }
    }
}

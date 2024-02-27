<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commentaires = [['Merci !', "2024-02-02"], ['Super intuitif !', "2024-02-02"]];

        foreach ($commentaires as $commentaire) {
            Commentaire::create([
                'contenu_com' => $commentaire[0],
                'date_com' => $commentaire[1]
            ]);
        }
    }
}

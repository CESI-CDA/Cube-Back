<?php

namespace Database\Seeders;

use App\Models\Ressource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RessourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ressources = [['Titre Ressource 1', 'Contenu Ressource 1', 'URL Ressource 1', 1, 1, 1, '2022-02-02 14:25:25', 0], ['Titre Ressource 2', 'Contenu Ressource 2', 'URL Ressource 2', 2, 1, 2, '2022-02-02 15:25:25', 0], ['Titre Ressource 3', 'Contenu Ressource 3', 'URL Ressource 3', 3, 2, 3, '2022-02-02 13:25:25', 1]];

        foreach ($ressources as $ressource)
        {
            Ressource::create([
                'titre_res' => $ressource[0],
                'contenu_res' => $ressource[1],
                'url_res' => $ressource[2],
                'id_type_res' => $ressource[3],
                'id_vis' => $ressource[4],
                'id_createur' => $ressource[5],
                'date_creation' => $ressource[6],
                'is_archive' => $ressource[7]
            ]);

        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\LienRessourceCategorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LienRessourceCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liensRessourceCategorie = [[1, 1], [1, 2], [2, 2]];

        foreach ($liensRessourceCategorie as $lienRessourceCategorie)
        {
            LienRessourceCategorie::create([
                'id_res' => $lienRessourceCategorie[0],
                'id_cat' => $lienRessourceCategorie[1]
            ]);

        }
    }
}

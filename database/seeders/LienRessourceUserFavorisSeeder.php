<?php

namespace Database\Seeders;

use App\Models\LienRessourceUserFavoris;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LienRessourceUserFavorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liensRessourceUserFavoris = [[1, 1], [1, 2], [2, 2]];

        foreach ($liensRessourceUserFavoris as $lienRessourceUserFavoris)
        {
            LienRessourceUserFavoris::create([
                'id_res' => $lienRessourceUserFavoris[0],
                'id_user' => $lienRessourceUserFavoris[1]
            ]);

        }
    }
}

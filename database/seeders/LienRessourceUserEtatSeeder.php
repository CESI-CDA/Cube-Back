<?php

namespace Database\Seeders;

use App\Models\LienRessourceUserEtat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LienRessourceUserEtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liensRessourceUserEtat = [[1, 1, 1], [1, 2, 2], [2, 2, 1]];

        foreach ($liensRessourceUserEtat as $lienRessourceUserEtat)
        {
            LienRessourceUserEtat::create([
                'id_res' => $lienRessourceUserEtat[0],
                'id_user' => $lienRessourceUserEtat[1],
                'id_etat' => $lienRessourceUserEtat[2]
            ]);

        }
    }
}

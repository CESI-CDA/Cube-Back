<?php

namespace Database\Seeders;

use App\Models\LienRessourceRelation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LienRessourceRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liensRessourceRelation = [[1, 1], [1, 2], [2, 2]];

        foreach ($liensRessourceRelation as $lienRessourceRelation)
        {
            LienRessourceRelation::create([
                'id_res' => $lienRessourceRelation[0],
                'id_rel' => $lienRessourceRelation[1]
            ]);

        }
    }
}

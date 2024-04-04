<?php

namespace Database\Seeders;

use App\Models\LienRessourceUserArchive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LienRessourceUserArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liensRessourceUserArchive = [[2, 2]];

        foreach ($liensRessourceUserArchive as $lienRessourceUserArchive)
        {
            LienRessourceUserArchive::create([
                'id_res' => $lienRessourceUserArchive[0],
                'id_user' => $lienRessourceUserArchive[1]
            ]);

        }
    }
}

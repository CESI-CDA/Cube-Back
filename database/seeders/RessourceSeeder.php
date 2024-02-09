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
        $ressources = [['', '', ''], ['', '', ''], ['', '', '']];

        foreach ($ressources as $ressource)
        {
            Ressource::create([
                'titre_res' => $ressource[0],
                'contenu_res' => $ressource[1],
                'url_res' => $ressource[2]
            ]);

        }
    }
}

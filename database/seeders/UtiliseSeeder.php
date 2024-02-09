<?php

namespace Database\Seeders;

use App\Models\Utilise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtiliseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utilises = [];

        foreach ($utilises as $utilise) {
            Utilise::create([
                'contenu_com' => $utilise
            ]);
        }
    }
}

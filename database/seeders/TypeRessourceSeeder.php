<?php

namespace Database\Seeders;

use App\Models\TypeRessource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeRessourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intitules = ['News', 'Exercice / Atelier', 'Documentaire'];

        foreach ($intitules as $intitule) {
            TypeRessource::create([
                'intitule_type_res' => $intitule
            ]);
        }
    }
}

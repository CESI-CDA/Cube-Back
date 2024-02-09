<?php

namespace Database\Seeders;

use App\Models\TypeEtat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeEtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intitules = ['En lecture', 'Lu'];

        foreach ($intitules as $intitule) {
            TypeEtat::create([
                'intitule_type_eta' => $intitule
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Visibilite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisibiliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intitules = ['Public', 'Privée'];

        foreach ($intitules as $intitule) {
            Visibilite::create([
                'intitule_vis' => $intitule
            ]);
        }
    }
}

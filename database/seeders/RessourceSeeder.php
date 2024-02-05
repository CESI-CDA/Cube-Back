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
        Ressource::create([
            'titre_res' => 'L\'épisode de neige en France',
            'contenu_res' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
            'url_res' => 'https://www.lipsum.com/'
        ]);
    }
}

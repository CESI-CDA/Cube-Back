<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(RelationSeeder::class);
        $this->call(TypeEtatSeeder::class);
        $this->call(TypeRessourceSeeder::class);
        $this->call(VisibiliteSeeder::class);
        $this->call(RessourceSeeder::class);
        $this->call(LienRessourceCategorieSeeder::class);
        $this->call(LienRessourceRelationSeeder::class);
        $this->call(LienRessourceUserArchiveSeeder::class);
        $this->call(LienRessourceUserEtatSeeder::class);
        $this->call(LienRessourceUserFavorisSeeder::class);
        $this->call(LienUserRestrictionSeeder::class);
        // $this->call(EtatCommentaireSeeder::class);
        $this->call(LienRessourceCommentaireSeeder::class);
    }
}

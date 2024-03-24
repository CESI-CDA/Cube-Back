<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ressources = [['Cuvilliez', 'Antoine', 'AntoineCuvilliez', 'antoine.cuvilliez@outlook.fr', 'azerty', 1], ['Faucon', 'Nathan', 'FauconNathan', 'faucon.nathan@viacesi.fr', 'azerty', 1], ['Vasseur', 'Helene', 'HeleneVasseur', 'vasseur.helene@viacesi.fr', 'azerty', 1], ['Forestier', 'Julien', 'JulienForestier', 'forestier.julien@viacesi.fr', 'azerty', 1], ['Dervaux', 'Maxime', 'MaximeDervaux', 'dervaux.maxime@viacesi.fr', 'azerty', 1]];

        foreach ($ressources as $ressource)
        {
            User::create([
                'nom' => $ressource[0],
                'prenom' => $ressource[1],
                'pseudonyme' => $ressource[2],
                'email' => $ressource[3],
                'password' => $ressource[4],
                'id_rol' => $ressource[5]
            ]);

        }
    }
}

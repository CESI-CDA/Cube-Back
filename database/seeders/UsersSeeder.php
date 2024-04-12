<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * The TruncateTableService instance.
     *
     * @var TruncateTableService
     */
    private $truncateTableService;

    /**
     * Constructor.
     *
     * @param TruncateTableService $truncateTableService
     */
    public function __construct(TruncateTableService $truncateTableService)
    {
        $this->truncateTableService = $truncateTableService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncateTableService->truncateTable('users');

        $userData = [
            ['id' => 1, 'nom' => 'Cuvilliez', 'prenom' => 'Antoine', 'pseudonyme' => 'AntoineCuvilliez', 'email' => 'antoine.cuvilliez@outlook.fr', 'password' => 'Antoxz59000!', 'id_rol' => 1],
            ['id' => 2, 'nom' => 'Faucon', 'prenom' => 'Nathan', 'pseudonyme' => 'FauconNathan', 'email' => 'nathan.faucon@viacesi.fr', 'password' => 'Noisyfox59000!', 'id_rol' => 1],
            ['id' => 3, 'nom' => 'Vasseur', 'prenom' => 'Helene', 'pseudonyme' => 'HeleneVasseur', 'email' => 'helene.vasseur@viacesi.fr', 'password' => 'LnVsr59000!', 'id_rol' => 1],
            ['id' => 4, 'nom' => 'Forestier', 'prenom' => 'Julien', 'pseudonyme' => 'JulienForestier', 'email' => 'julien.forestier@viacesi.fr', 'password' => 'Bad0ck59000!', 'id_rol' => 1],
            ['id' => 5, 'nom' => 'Dervaux', 'prenom' => 'Maxime', 'pseudonyme' => 'MaximeDervaux', 'email' => 'maxime.dervaux@viacesi.fr', 'password' => 'Proxyme59000!', 'id_rol' => 1]
        ];

        foreach ($userData as $user) {
            User::create([
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'pseudonyme' => $user['pseudonyme'],
                'email' => $user['email'],
                'password' => $user['password'],
                'id_rol' => $user['id_rol']
            ]);
        }
    }
}



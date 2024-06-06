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
            ['id' => 5, 'nom' => 'Dervaux', 'prenom' => 'Maxime', 'pseudonyme' => 'MaximeDervaux', 'email' => 'maxime.dervaux@viacesi.fr', 'password' => 'Proxyme59000!', 'id_rol' => 1],
            ['id' => 6, 'nom' => 'Dupont', 'prenom' => 'Michel', 'pseudonyme' => 'MichelDupont', 'email' => 'michel.dupont@projet-ressources.fr', 'password' => 'MichDup59000!', 'id_rol' => 2],
            ['id' => 7, 'nom' => 'Lefevre', 'prenom' => 'Alain', 'pseudonyme' => 'AlainLefevre', 'email' => 'alain.lefevre@projet-ressources.fr', 'password' => 'AlainLef59000!', 'id_rol' => 2],
            ['id' => 8, 'nom' => 'Smith', 'prenom' => 'Benjamin', 'pseudonyme' => 'SmithBenjamin', 'email' => 'smith.benjamin@projet-ressources.fr', 'password' => 'BenjSmith59000!', 'id_rol' => 3],
            ['id' => 9, 'nom' => 'Flordelis', 'prenom' => 'Ferland', 'pseudonyme' => 'FerlandFlordelis', 'email' => 'ferland.flordelis@projet-ressources.fr', 'password' => 'FerlandFlor59000!', 'id_rol' => 3],        
            ['id' => 10, 'nom' => 'Soriol', 'prenom' => 'Gabriel', 'pseudonyme' => 'SoriolGabriel', 'email' => 'soriol.gabriel@projet-ressources.fr', 'password' => 'GabSor59000!', 'id_rol' => 4],
            ['id' => 11, 'nom' => 'Dumoulin', 'prenom' => 'Jean', 'pseudonyme' => 'JeanDumoulin', 'email' => 'jean.dumoulin@projet-ressources.fr', 'password' => 'JeanDumou59000!', 'id_rol' => 4],
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



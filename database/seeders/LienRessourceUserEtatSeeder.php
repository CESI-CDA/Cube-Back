<?php

namespace Database\Seeders;

use App\Models\LienRessourceUserEtat;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class LienRessourceUserEtatSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('lien_ressource_user_etat');
        $lienRessourceUserEtatData = [
            ['id_res' => 1, 'id_user' => 1, 'id_etat' => 1],
            ['id_res' => 1, 'id_user' => 2, 'id_etat' => 2],
            ['id_res' => 2, 'id_user' => 2, 'id_etat' => 1]
        ];

        foreach ($lienRessourceUserEtatData as $lienRessourceUserEtat) {
            LienRessourceUserEtat::create([
                'id_res' => $lienRessourceUserEtat['id_res'],
                'id_user' => $lienRessourceUserEtat['id_user'],
                'id_etat' => $lienRessourceUserEtat['id_etat']
            ]);
        }
    }
}

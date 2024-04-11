<?php

namespace Database\Seeders;

use App\Models\LienRessourceUserArchive;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class LienRessourceUserArchiveSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('lien_ressource_user_archive');
        $lienRessourceUserArchiveData = [
            ['id_res' => 2, 'id_user' => 2]
        ];

        foreach ($lienRessourceUserArchiveData as $lienRessourceUserArchive) {
            LienRessourceUserArchive::create([
                'id_res' => $lienRessourceUserArchive['id_res'],
                'id_user' => $lienRessourceUserArchive['id_user']
            ]);
        }
    }
}



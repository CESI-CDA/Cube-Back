<?php

namespace Database\Seeders;

use App\Models\Visibilite;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class VisibiliteSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('visibilite');
        $visibiliteData = [
            ['id' => 1, 'intitule_vis' => 'Public'],
            ['id' => 2, 'intitule_vis' => 'Privée']
        ];

        foreach ($visibiliteData as $visibilite) {
            Visibilite::create([
                'id' => $visibilite['id'],
                'intitule_vis' => $visibilite['intitule_vis']
            ]);
        }
    }
}



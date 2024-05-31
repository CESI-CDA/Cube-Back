<?php

namespace Database\Seeders;

use App\Models\EtatCommentaire;
use App\Models\LienUserRestriction;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class LienUserRestrictionSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('lien_user_restriction');
        $lienUserRestrictionData = [
            ['id' => 1, 'id_user' => 1, 'date' => '2025-01-01 15:22:36', 'commentaire' => 'En retard (vomis dans le métro)']
        ];

        foreach ($lienUserRestrictionData as $lienUserRestriction) {
            LienUserRestriction::create([
                'id' => $lienUserRestriction['id'],
                'id_user' => $lienUserRestriction['id_user'],
                'date' => $lienUserRestriction['date'],
                'commentaire' => $lienUserRestriction['commentaire']
            ]);
        }
    }
}

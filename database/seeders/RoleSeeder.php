<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Services\TruncateTableService;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
        $this->truncateTableService->truncateTable('role');
        $roleData = [
            ['id' => 1, 'intitule_rol' => 'Super-administrateur'],
            ['id' => 2, 'intitule_rol' => 'Administrateur'],
            ['id' => 3, 'intitule_rol' => 'Modérateur'],
            ['id' => 4, 'intitule_rol' => 'Citoyen']
        ];

        foreach ($roleData as $role) {
            Role::create([
                'id' => $role['id'],
                'intitule_rol' => $role['intitule_rol']
            ]);
        }
    }
}


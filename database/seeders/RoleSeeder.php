<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super-administrateur', 'Administrateur', 'Modérateur', 'Citoyen'];

        foreach ($roles as $role) {
            Role::create([
                'titre_type_res' => $role
            ]);
        }

            
    }
}

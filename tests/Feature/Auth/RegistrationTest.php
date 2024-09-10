<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_new_users_can_register(): void
    {
        $this->post('/api/register', [
            'nom' => 'Test',
            'prenom' => 'User',
            'pseudonyme' => 'UserTest',
            'email' => 'test@example.com',
            'password' => 'LaravelDev123!',
            'password_confirmation' => 'LaravelDev123!',
            'id_rol' => 4
        ]);

        $this->assertAuthenticated();
    }
}

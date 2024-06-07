<?php

namespace Tests\Feature;

use App\Models\LienRessourceCategorie;
use App\Models\LienRessourceRelation;
use App\Models\Ressource;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RessourceControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function store_a_new_ressource_successfully()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $data = [
            'titre_res' => 'Titre Test',
            'contenu_res' => 'Contenu Test',
            'url_res' => 'http://example.com',
            'id_type_res' => 1,
            'id_vis' => 1,
            'id_createur' => 1,
            'arrayIdCat' => [1, 2],
            'arrayIdRel' => [1, 2]
        ];

        $response = $this->postJson('/api/ressources', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('ressource', [
            'titre_res' => 'Titre Test',
            'contenu_res' => 'Contenu Test',
            'url_res' => 'http://example.com',
            'id_type_res' => 1,
            'id_vis' => 1,
            'id_createur' => 1,
            'is_archive' => 0,
            'id_etat' => 1
        ]);

        foreach ($data['arrayIdCat'] as $catId) {
            $this->assertDatabaseHas('lien_ressource_categorie', [
                'id_cat' => $catId
            ]);
        }

        foreach ($data['arrayIdRel'] as $relId) {
            $this->assertDatabaseHas('lien_ressource_relation', [
                'id_rel' => $relId
            ]);
        }
    }

}

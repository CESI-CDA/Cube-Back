<?php

namespace Tests\Unit;

namespace Tests\Unit;

use App\Http\Requests\StoreRessourceRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class RessourceControllerUnitTest extends TestCase
{
    public function test_validate_successful_data()
    {
        $data = [
            'titre_res' => 'Valid Ressource',
            'contenu_res' => 'Valid Contenu',
            'url_res' => 'https://exemple.com',
            'id_type_res' => 1,
            'id_vis' => 1,
            'id_createur' => 1,
            'arrayIdCat' => [1, 2],
            'arrayIdRel' => [1, 2],
        ];

        $request = new StoreRessourceRequest();
        $rules = $request->rules();
        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->passes());
    }
}

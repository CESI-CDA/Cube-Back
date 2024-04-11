<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register",
     *     tags={"AuthLogin"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "pseudonyme", "email", "password", "password_confirmation"},
     *             @OA\Property(property="nom",  type="string", maxLength=255),
     *             @OA\Property(property="prenom",  type="string", maxLength=255),
     *             @OA\Property(property="pseudonyme",  type="string", maxLength=255),
     *             @OA\Property(property="email",  type="string", maxLength=255),
     *             @OA\Property(property="password",  type="string", maxLength=255),
     *             @OA\Property(property="password_confirmation",  type="string", maxLength=255)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'pseudonyme' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'pseudonyme' => $request->pseudonyme,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => 4
        ]);

        event(new Registered($user));

        Auth::login($user);

        $token = $user->createToken('api-token');

        unset($user['password']);

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
}

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

        // 15|0z3gtIQUwHA7LE7uwP69voo23OUROWTTlsBykeVSfda768c3
    }
}

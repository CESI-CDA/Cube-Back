<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */

     /**
     * @OA\Post(
     *     path="/login",
     *     summary="Login",
     *     tags={"AuthLogin"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */
    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();
            $user = Auth::user();
            $user = User::where('id', $user->id)
                ->firstOrFail();
            $userInfos['access_token'] = $user->createToken('token-name', ['server:update'])->plainTextToken;
            session(['collaborateur_infos' => $userInfos]);
            $request->session()->regenerate();
            return response()->json(['user' => $user, 'message' => 'Authentication successful'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     */

      /**
     * @OA\Post(
     *     path="/logout",
     *     summary="Logout",
     *     tags={"AuthLogin"},
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Disconnection successful'], 200);
    }
}

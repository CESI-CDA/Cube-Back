<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login",
     *     tags={"AuthLogin"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email",  type="string", maxLength=255),
     *             @OA\Property(property="password",  type="string", maxLength=255)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     *     * )
     */
    public function store(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();

            $user = $request->user();

            $user->tokens()->delete();

            $bannedUser = User::whereHas('getLienUserRestriction')->find($user->id);
            if ($bannedUser) {
                $dateRestriction = $user->getLienUserRestriction()->first();
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                
                return response()->json([
                    'message' => 'L\'utilisateur est restreint jusqu\'au ' . Carbon::parse($dateRestriction->date)->format('d-m-Y h:i:s') . ' pour la raison : ' . $dateRestriction->commentaire
                ], 401);
            } else {
                $token = $user->createToken('api-token', ['server:update'])->plainTextToken;

                $request->session()->regenerate();

                return response()->json([
                    'user' => $user,
                    'token' => $token
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     */

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout",
     *     tags={"AuthLogin"},
     *     @OA\Response(response=200, description="Item deleted successfully"),
     *     @OA\Response(response=404, description="Item not found"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->tokens()->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Disconnection sucessful',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\PasswordResetTokens;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    /**
     * @OA\Post(
     *     path="/api/forgot-password",
     *     summary="Send password reset link",
     *     tags={"AuthLogin"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string"),
     *         )
     *     ),
     *     @OA\Response(response=201, description="Item created successfully"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Internal server error"),
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = $user->createToken('password-reset', ['expires' => Carbon::now()->addMinutes(30)])->plainTextToken;
            PasswordResetTokens::where('email', $user->email)->delete();
            PasswordResetTokens::create([
                'email' => $user->email,
                'token' => Hash::make($token),
            ]);
            $route = env('FRONTEND_URL').'/resetpassword?token='.$token.'?email='.$user->email;
            $resetLink = str_replace('%7C', '|', urldecode($route));
            $infos = [
                'resetLink' => $resetLink
            ];
            Mail::to($user->email)->send(new PasswordResetMail($infos));
        }
        return response()->json(['status' => true, 'message' => 'Si l\'adresse mail est associée à un compte dans notre système, un mail a été envoyé avec un lien de réinitialisation.'], 200);
    }
}

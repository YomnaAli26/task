<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Mail\VerificationCodeMail;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use ResponseTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(AuthRequest $request): JsonResponse
    {
        try {
            $verificationCode = random_int(100000, 999999);

            // Create a new user with the provided details and generated verification code
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'verification_code' => $verificationCode,
            ]);

            // Send the verification code to the user's email
//            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            // Create an API token for the new user
            $token = $user->createToken($request->email)->plainTextToken;
            $user->token = $token;

            // Return a successful response with user data and a message
            return $this->getResponse(201,
                message: "User registered successfully. Please check your email for the verification code.",
                data: UserResource::make($user));

        } catch (\Exception $exception) {
            // Log the exception message
            Log::error($exception->getMessage());
            return $this->getResponse(500, message: 'Registration failed. Please try again.');
        }
    }
}

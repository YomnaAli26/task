<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ResponseTrait;

    /**
     * Handle user login and return a token if successful.
     */
    public function __invoke(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        // Attempt to authenticate the user
        if (!Auth::once($credentials)) {
            return $this->getResponse(401, message: 'Invalid credentials.');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user's account is verified
        if (!$user->is_verified) {
            return $this->getResponse(403, message: 'Your account is not verified.');
        }

        // Generate a new API token for the user
        $token = $user->createToken($request->email)->plainTextToken;

        // Attach the token to the user object
        $user->token = $token;
        return $this->getResponse(data: UserResource::make($user));
    }
}

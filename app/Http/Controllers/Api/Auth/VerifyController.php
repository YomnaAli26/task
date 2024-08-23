<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    use ResponseTrait;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'verification_code' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->verification_code)
            ->first();

        // Check if user is found
        if (!$user) {
            // Return error response if verification code is invalid
            return $this->getResponse(400, message: 'Invalid verification code.');
        }

        // Mark user as verified and clear the verification code
        $user->is_verified = true;
        $user->verification_code = null;
        $user->save();

        // Return success response
        return $this->getResponse(200, message: 'Account successfully verified.');
    }
}

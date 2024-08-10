<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\JsonResponse;

class LoginController extends Controller
{
    use JsonResponse;
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('username', 'password'))) {
            return $this->error(401, 'Invalid credentials');
        }

        $user = auth()->user();

        if ($request->type === $user->role) {
            $token = $user->createToken($user->role)->plainTextToken;
            return $this->ok(200, 'Welcome back, ' . $user->name, ['token' => $token]);
        } else {
            return $this->error(401, 'Invalid credentials');
        }

    }
}

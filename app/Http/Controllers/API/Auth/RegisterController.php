<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\WelcomeUserJob;
use App\Models\User;
use App\Traits\JsonResponse;

class RegisterController extends Controller
{
    use JsonResponse;
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken('token_from_register')->plainTextToken;

        WelcomeUserJob::dispatch($user);

        return $this->ok(201, 'User registered successfully', ['token' => $token]);
    }
}

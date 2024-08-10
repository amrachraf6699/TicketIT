<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SessionseResource;
use App\Http\Resources\SessionsResource;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    use JsonResponse;


    public function index(Request $request)
    {
        $user = $request->user();
        $user = $user->load('tokens');

        return $this->ok(
            200,
            $user->name . "'s Active Sessions",
            [
                'count' => $user->tokens->count(),
                'sessions' => SessionsResource::collection($user->tokens)
            ]
        );
    }


    public function destroy(Request $request, $type)
    {
        $user = $request->user();
        $tokens = $user->tokens();

        switch ($type) {
            case 'all':
                $tokens->delete();
                $message = 'All Sessions Deleted Successfully';
                break;
            case 'current':
                $user->currentAccessToken()->delete();
                $message = 'Current Session Deleted Successfully';
                break;
            case 'other':
                $tokens->where('id', '!=', $user->currentAccessToken()->id)->delete();
                $message = 'Other Sessions Deleted Successfully';
                break;
            default:
                $tokens->where('id', $type)->delete();
                $message = 'Session Deleted Successfully';
                break;
        }

        return $this->ok(200, $message);
    }
}

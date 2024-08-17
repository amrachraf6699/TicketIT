<?php

namespace App\Http\Middleware;

use App\Traits\JsonResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    use JsonResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        if ($user->role !== $role) {
            return $this->error(403, 'You are not authorized to make this action');
        }

        return $next($request);
    }
}

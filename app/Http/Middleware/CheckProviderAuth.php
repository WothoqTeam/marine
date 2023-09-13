<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProviderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check=auth('api')->user();
        if ($check and $check->hasRole('provider')){
            return $next($request);
        }else{
            return response()->json([
                'success' => false,
                'message' => "Unauthorized",
                'data' => array()
            ],401);
        }
    }
}

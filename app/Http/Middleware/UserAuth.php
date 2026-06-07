<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('user_id')) {
            return redirect()->route('register');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->session()->get('User');
        $isAdmin = $request->session()->get('is_admin');

        if (empty($user) || empty($isAdmin) || (int) $isAdmin !== 1) {
            return redirect()->route('register', ['need' => 'admin']);
        }

        return $next($request);
    }
}

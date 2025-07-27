<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_logged_in')) {
            return redirect()->route('user.login')->withErrors(['auth' => 'Please login first']);
        }

        return $next($request);
    }
}

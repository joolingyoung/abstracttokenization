<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Closure;

class AuthDetails {
    public function handle($request, Closure $next) {
        $user = Auth::user();
        View::share('user', $user);
        $request->user = $user;
        return $next($request);
    }
}
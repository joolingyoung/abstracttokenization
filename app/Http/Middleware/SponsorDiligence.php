<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\AccountVerification;
use Illuminate\Support\Facades\View;
use Closure;

class SponsorDiligence {
    public function handle($request, Closure $next) {
        $user = Auth::id();
        $request->sponsor_approved = AccountVerification::where(['status' => 'Approved'], ['userid' => $user])->exists();
        View::share('sponsor_approved', $request->sponsor_approved);
        return $next($request);
    }
}
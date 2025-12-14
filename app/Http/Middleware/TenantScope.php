<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TenantScope
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();


            if ($user->hasRole('super-admin')) {
                return $next($request);
            }


            if (!$user->tenant_id) {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'No tenant assigned to your account. Please contact administrator.');
            }

            // Set global tenant scope in confi
            config(['app.current_tenant_id' => $user->tenant_id]);

            // Set in session for easy access
            session(['tenant_id' => $user->tenant_id]);
        }

        return $next($request);
    }
}

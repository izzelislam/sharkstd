<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BackOffice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::guard("admin")->user()->role;
        if ($role === "contributor" || $role === "administrator" ){
            return $next($request);
        }

        return redirect()->route("bo.login.index")->with("error", "You does'nt have acess.");
    }
}

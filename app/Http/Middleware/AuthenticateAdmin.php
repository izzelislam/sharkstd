<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AuthenticateAdmin extends Middleware
{
     /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        dd($request->is("administrator"));
        return null;
        // return $request->expectsJson() ? null : route("bo.login.index");
    }
}

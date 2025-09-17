<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        // لو الطلب مش JSON → رجعه على welcome
        if (! $request->expectsJson()) {
            return route('auth.login'); // أو أي مسار بدك ياه
        }
        return null;
    }
}

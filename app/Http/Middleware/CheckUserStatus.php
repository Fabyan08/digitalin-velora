<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// app/Http/Middleware/CheckUserStatus.php

namespace App\Http\Middleware;

use Closure;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->status == 'Tidak Aktif') {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

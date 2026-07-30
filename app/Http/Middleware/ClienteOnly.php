<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClienteOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isCliente()) {
            abort(403, 'Acceso restringido a clientes.');
        }

        return $next($request);
    }
}

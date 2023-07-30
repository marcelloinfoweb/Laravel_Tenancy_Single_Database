<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantControllerAccessRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Tenant: Acessa o painel de gerenciamento para o gerenciamento de seus clientes
        // Tenant Customer: Não pode acessar o painel do gerenciamento
        // Admin: Gerencia o projeto tenant, deve ter o gereciamento dos seus tenants e do sistema

        return $next($request);
    }
}

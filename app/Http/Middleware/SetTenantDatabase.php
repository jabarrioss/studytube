<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SetTenantDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only set tenant database for authenticated users
        if ($request->user()) {
            $userUuid = $request->user()->uuid;
            
            // Set the tenant database path
            $tenantDbPath = database_path("tenants/user_{$userUuid}.sqlite");
            
            // Update the tenant connection configuration
            Config::set('database.connections.tenant.database', $tenantDbPath);
            
            // Purge the connection to ensure fresh connection with new path
            DB::purge('tenant');
            
            // Reconnect with the new configuration
            DB::reconnect('tenant');
        }

        return $next($request);
    }
}

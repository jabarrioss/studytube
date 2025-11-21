<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateTenantDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;
        $userUuid = $user->uuid;

        // Define tenant database path
        $tenantDbPath = database_path("tenants/user_{$userUuid}.sqlite");

        // Create the database file if it doesn't exist
        if (!File::exists($tenantDbPath)) {
            File::put($tenantDbPath, '');
        }

        // Temporarily set the tenant connection to this new database
        Config::set('database.connections.tenant.database', $tenantDbPath);
        DB::purge('tenant');
        DB::reconnect('tenant');

        // Run tenant migrations
        $migrationPath = database_path('migrations/tenant');
        
        // Run migrations on the tenant connection
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ]);
    }
}


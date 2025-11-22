<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateMissingTenantDatabases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create-missing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create tenant databases for users who don\'t have them yet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $created = 0;

        foreach ($users as $user) {
            $tenantDbPath = database_path("tenants" . DIRECTORY_SEPARATOR . "user_{$user->uuid}.sqlite");

            if (!File::exists($tenantDbPath)) {
                $this->info("Creating tenant database for user: {$user->email} (UUID: {$user->uuid})");

                // Create tenants directory if it doesn't exist
                $tenantsDir = database_path('tenants');
                if (!File::exists($tenantsDir)) {
                    File::makeDirectory($tenantsDir, 0755, true);
                }

                // Create the database file
                File::put($tenantDbPath, '');

                // Configure the tenant connection
                Config::set('database.connections.tenant.database', $tenantDbPath);
                DB::purge('tenant');
                DB::reconnect('tenant');

                // Run tenant migrations
                Artisan::call('migrate', [
                    '--database' => 'tenant',
                    '--path' => 'database/migrations/tenant',
                    '--force' => true,
                ]);

                $this->info("✓ Created tenant database: {$tenantDbPath}");
                $created++;
            } else {
                $this->info("✓ Tenant database already exists for: {$user->email}");
            }
        }

        $this->info("\nSummary: Created {$created} tenant database(s)");
        return Command::SUCCESS;
    }
}

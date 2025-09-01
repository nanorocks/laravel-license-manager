<?php

namespace Nanorocks\LicenseManager;

use Illuminate\Support\ServiceProvider;
use Nanorocks\LicenseManager\Services\LicenseService;

class LicenseManagerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            // Publishes migrations
            $this->publishes([
                __DIR__ . '/../database/migrations/2025_09_01_000000_create_licenses_table.php' => database_path('migrations/2025_09_01_000000_create_licenses_table.php'),
            ], 'license-manager-migrations');

            // Publishes config
            $this->publishes([
                __DIR__ . '/../config/license-manager.php' => config_path('license-manager.php'),
            ], 'license-manager-config');

            // Commands
            if (class_exists(\Nanorocks\LicenseManager\Commands\GenerateLicenseCommand::class)) {
                $this->commands([
                    \Nanorocks\LicenseManager\Commands\GenerateLicenseCommand::class,
                    \Nanorocks\LicenseManager\Commands\RevokeLicenseCommand::class,
                ]);
            }
        }
    }

    public function register(): void
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/license-manager.php',
            'license-manager'
        );

        // Bind the License Service
        $this->app->singleton('license-manager', function () {
            return new LicenseService();
        });
    }
}

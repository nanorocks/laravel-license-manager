<?php

namespace Nanorocks\LicenseManager;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Nanorocks\LicenseManager\Commands\GenerateLicenseCommand;
use Nanorocks\LicenseManager\Commands\RevokeLicenseCommand;

class LicenseManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('license-manager')
            ->hasConfigFile() // Publishes config/license-manager.php
            ->hasMigration('create_licenses_table') // Publishes migration
            ->hasCommand(GenerateLicenseCommand::class)
            ->hasCommand(RevokeLicenseCommand::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            // Publishes only the config
            $this->publishes([
                __DIR__ . '/../config/license-manager.php' => config_path('license-manager.php'),
            ], 'license-manager-config');

            // Publishes the specific migration
            $this->publishes([
                __DIR__ . '/../database/migrations/2025_09_01_000000_create_licenses_table.php' => database_path('migrations/2025_09_01_000000_create_licenses_table.php'),
            ], 'license-manager-migrations');
        }
    }

    public function register(): void
    {
        // Merge config from package root
        $this->mergeConfigFrom(
            __DIR__ . '/../config/license-manager.php',
            'license-manager'
        );
    }
}

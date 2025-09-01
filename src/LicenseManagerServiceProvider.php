<?php

namespace Nanorocks\LicenseManager;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Nanorocks\LicenseManager\Commands\RevokeLicenseCommand;
use Nanorocks\LicenseManager\Commands\GenerateLicenseCommand;

class LicenseManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('license-manager')
            ->hasConfigFile()
            ->hasMigration('create_licenses_table')
            ->hasCommand(GenerateLicenseCommand::class)
            ->hasCommand(RevokeLicenseCommand::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Nanorocks\LicenseManager\Commands\GenerateLicenseCommand::class,
            ]);
            $this->publishes([
                __DIR__ . '/../config/license-manager.php' => config_path('license-manager.php'),
            ], 'license-manager-config');
        }
    }

    public function register(): void
    {
        // Merge config from package root config folder
        $this->mergeConfigFrom(
            __DIR__ . '/../config/license-manager.php',
            'license-manager'
        );
    }
}

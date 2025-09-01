<?php

namespace Nanorocks\LicenseManager\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider.
     */
    protected function getPackageProviders($app)
    {
        return [
            \Nanorocks\LicenseManager\LicenseManagerServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('license-manager.default_expiry_days', 365);
    }

    /**
     * Load package aliases (facades), ако користиш.
     */
    protected function getPackageAliases($app)
    {
        return [
            // 'LicenseManager' => \Nanorocks\LicenseManager\Facades\LicenseManager::class,
        ];
    }

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Run migrations for package
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Optionally seed data if needed
        // $this->artisan('db:seed', ['--class' => 'LicenseSeeder']);
    }
}

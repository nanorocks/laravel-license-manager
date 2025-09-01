<?php

namespace Nanorocks\LicenseManager\Commands;

use Illuminate\Console\Command;
use Nanorocks\LicenseManager\Models\License;

class RevokeLicenseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:revoke
                            {license_key : The license key to revoke}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate (revoke) an existing license key';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $licenseKey = $this->argument('license_key');

        $license = License::where('license_key', $licenseKey)->first();

        if (! $license) {
            $this->error("❌ License with key '{$licenseKey}' not found.");
            return self::FAILURE;
        }

        if (! $license->active) {
            $this->warn("⚠️ License '{$licenseKey}' is already inactive.");
            return self::SUCCESS;
        }

        $license->update(['active' => false]);

        $this->info("✅ License '{$licenseKey}' has been successfully revoked.");
        return self::SUCCESS;
    }
}

<?php

namespace Nanorocks\LicenseManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Nanorocks\LicenseManager\Models\License;

class GenerateLicenseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:generate
                            {--assigned-to= : Email or Client ID to assign license}
                            {--expires-in= : Expiration in days (default from config)}
                            {--key-length= : Length of license key (default from config)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new license key and store it in the database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $keyLength = $this->option('key-length') ?? config('license-manager.key_length', 16);
        $expirationDays = $this->option('expires-in') ?? config('license-manager.default_expiration_days');

        $licenseKey = strtoupper(Str::random($keyLength));

        $license = License::create([
            'license_key' => $licenseKey,
            'assigned_to' => $this->option('assigned-to'),
            'active' => true,
            'expires_at' => $expirationDays ? now()->addDays($expirationDays) : null,
            'metadata' => [],
        ]);

        $this->info("✅ License generated successfully!");
        $this->line("🔑 License Key: {$license->license_key}");
        if ($license->expires_at) {
            $this->line("📅 Expires At: {$license->expires_at}");
        }
        if ($license->assigned_to) {
            $this->line("👤 Assigned To: {$license->assigned_to}");
        }

        return self::SUCCESS;
    }
}

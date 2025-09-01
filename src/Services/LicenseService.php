<?php

namespace Nanorocks\LicenseManager\Services;

use Nanorocks\LicenseManager\Models\License;

class LicenseService
{
    public function validateLicense(string $licenseKey): bool
    {
        $license = License::where('license_key', $licenseKey)->first();
        return $license ? $license->isValid() : false;
    }

    public function assignLicense(string $licenseKey, string $assignedTo): bool
    {
        $license = License::where('license_key', $licenseKey)->first();
        if (! $license) return false;

        $license->assigned_to = $assignedTo;
        $license->save();
        return true;
    }

    public function createLicense(array $data): License
    {
        return License::create($data);
    }

    public function deactivateLicense(string $licenseKey): bool
    {
        $license = License::where('license_key', $licenseKey)->first();
        if (! $license) return false;

        $license->active = false;
        $license->save();
        return true;
    }
}


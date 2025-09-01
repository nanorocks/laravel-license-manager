<?php

namespace Nanorocks\LicenseManager\Tests\Feature;

use Nanorocks\LicenseManager\Models\License;
use Nanorocks\LicenseManager\Services\LicenseService;
use Illuminate\Support\Str;

it('validates a license key', function () {
    // manually create a license
    $license = License::create([
        'license_key' => 'TEST-123',
        'assigned_to' => null,
        'active' => true,
        'expires_at' => now()->addDays(30),
        'metadata' => null,
    ]);

    $service = app(LicenseService::class);

    expect($service->validateLicense('TEST-123'))->toBeTrue();
    expect($service->validateLicense('INVALID'))->toBeFalse();
});

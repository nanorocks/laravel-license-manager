<?php

namespace Nanorocks\LicenseManager\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Nanorocks\LicenseManager\Models\License;
use Nanorocks\LicenseManager\Services\LicenseService;
use Nanorocks\LicenseManager\Tests\TestCase;

uses(TestCase::class)->in('Feature');

it('assigns license to user', function () {

    $this->artisan('migrate');

    $licenseId = DB::table('licenses')->insertGetId([
        'license_key' => 'ASSIGN-123',
        'active' => true,
        'assigned_to' => null,
        'metadata' => json_encode([]),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $service = app(LicenseService::class);

    $result = $service->assignLicense('ASSIGN-123', 'user@example.com');

    expect($result)->toBeTrue();

    $updatedLicense = DB::table('licenses')
        ->where('id', $licenseId)
        ->first();

    expect($updatedLicense->assigned_to)->toBe('user@example.com');
});

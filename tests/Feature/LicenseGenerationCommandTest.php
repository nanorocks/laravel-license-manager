<?php

namespace Nanorocks\LicenseManager\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Nanorocks\LicenseManager\Models\License;
use Nanorocks\LicenseManager\Tests\TestCase;

uses(TestCase::class)->in('Feature');

it('generates a license via artisan command', function () {

    Artisan::call('migrate');


    $this->artisan('license:generate', [
        '--assigned-to' => 'test@example.com',
        '--key-length' => 16,
        '--expires-in' => 30,
    ])->assertExitCode(0);


    $this->assertDatabaseHas('licenses', [
        'assigned_to' => 'test@example.com',
        'active' => true,
    ]);


    $license = DB::table('licenses')
        ->where('assigned_to', 'test@example.com')
        ->first();

    expect(strlen($license->license_key))->toBe(16);


    expect($license->expires_at)->not()->toBeNull();
});

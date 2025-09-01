<?php

namespace Nanorocks\LicenseManager\Tests\Feature;

it('loads config values', function () {
    $defaultExpiry = config('license-manager.default_expiry_days');
    expect($defaultExpiry)->toBeInt();
});

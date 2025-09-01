<?php

namespace Nanorocks\LicenseManager\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nanorocks\LicenseManager\Models\License;

class LicenseFactory extends Factory
{
    protected $model = License::class;

    public function definition(): array
    {
        return [
            'license_key' => $this->faker->unique()->bothify('TEST-###-????'),
            'assigned_to' => null,
            'active' => true,
            'expires_at' => now()->addDays(30),
            'metadata' => null,
        ];
    }
}

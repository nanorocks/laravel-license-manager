<?php

namespace Nanorocks\LicenseManager\Facades;

use Illuminate\Support\Facades\Facade;
use Nanorocks\LicenseManager\Services\LicenseService;

/**
 * @see \Nanorocks\LicenseManager\Services\LicenseService
 */
class LicenseManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LicenseService::class;
    }
}

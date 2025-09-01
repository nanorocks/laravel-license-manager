<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default License Length
    |--------------------------------------------------------------------------
    |
    | When generating new licenses via the command or service, this is
    | the length (in characters) of the license key.
    |
    */
    'key_length' => 16,

    /*
    |--------------------------------------------------------------------------
    | Default Expiration Period
    |--------------------------------------------------------------------------
    |
    | You can configure the default expiration period (in days).
    | If set to null, licenses will not expire unless specified.
    |
    */
    'default_expiration_days' => 365,

    /*
    |--------------------------------------------------------------------------
    | License Model
    |--------------------------------------------------------------------------
    |
    | This is the model used for license storage. You may override this if
    | you want to extend the model with additional relationships or logic.
    |
    */
    'model' => \Nanorocks\LicenseManager\Models\License::class,

    /*
    |--------------------------------------------------------------------------
    | License Validation Rules
    |--------------------------------------------------------------------------
    |
    | Here you can define custom rules for validating license usage.
    | For example, limit usage per domain, per IP, etc.
    |
    */
    'validation_rules' => [
        'check_expiry' => true,
        'check_active' => true,
    ],

];

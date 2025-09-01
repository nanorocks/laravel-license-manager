<?php

namespace Nanorocks\LicenseManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'license_key',
        'assigned_to',
        'active',
        'expires_at',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'expires_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function isValid(): bool
    {
        return $this->active && (! $this->expires_at || $this->expires_at->isFuture());
    }

    protected static function newFactory(): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return \Nanorocks\LicenseManager\Database\Factories\LicenseFactory::new();
    }
}

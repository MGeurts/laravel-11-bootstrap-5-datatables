<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso2',
        'iso3',
        'is_eu',
    ];

    protected $casts = [
        'is_eu' => 'boolean',
    ];

    /* -------------------------------------------------------------------------------------------- */
    // Accessors & Mutators
    /* -------------------------------------------------------------------------------------------- */
    protected function Name(): Attribute
    {
        return new Attribute(
            set:fn($value) => $value ? ucwords($value) : null,
        );
    }

    protected function Iso2(): Attribute
    {
        return new Attribute(
            set:fn($value) => $value ? strtoupper($value) : null,
        );
    }

    protected function Iso3(): Attribute
    {
        return new Attribute(
            set:fn($value) => $value ? strtoupper($value) : null,
        );
    }
}

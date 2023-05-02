<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_last_name',
        'customer_first_name',
        'company_name',
        'company_vat',

        'address_street',
        'address_number',
        'address_country',
        'address_postal_code',
        'address_place',

        'phone',
        'email',

        'delivery_address_street',
        'delivery_address_number',
        'delivery_address_country',
        'delivery_address_postal_code',
        'delivery_address_place',

        'send_newsletter',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'customer',
        'address',
        'place',
    ];

    /* -------------------------------------------------------------------------------------------- */
    // Accessors & Mutators
    /* -------------------------------------------------------------------------------------------- */
    protected function CustomerLastName(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value ? strtoupper($value) : null,
        );
    }

    protected function CustomerFirstName(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value ? ucwords($value) : null,
        );
    }

    protected function AddressStreet(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value ? ucwords($value) : null,
        );
    }

    protected function AddressPlace(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value ? strtoupper($value) : null,
        );
    }

    protected function Email(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value ? strtolower($value) : null,
        );
    }

    /* -------------------------------------------------------------------------------------------- */
    // Accessors (GET) Attribute (APPENDED)
    /* -------------------------------------------------------------------------------------------- */
    public function getCustomerAttribute()
    {
        return implode(' ', array_filter([$this->attributes['customer_last_name'], $this->attributes['customer_first_name']]));
    }

    public function getAddressAttribute()
    {
        return implode(' ', array_filter([
            $this->attributes['address_street'],
            $this->attributes['address_number'],
        ]));
    }

    public function getPlaceAttribute()
    {
        return implode(' ', array_filter([$this->attributes['address_postal_code'], $this->attributes['address_place']]));
    }
}

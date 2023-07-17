<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_last_name' => strtoupper(fake()->lastName()),
            'customer_first_name' => fake()->firstName(),
            'company_name' => fake()->boolean(30) ? fake()->company() : null,

            'address_street' => fake()->streetName(),
            'address_number' => fake()->buildingNumber(),
            'address_country' => fake()->countryCode('alpha-2'),
            'address_postal_code' => fake()->postcode(),
            'address_place' => strtoupper(fake()->city()),

            'phone' => fake()->e164PhoneNumber(),
            'email' => fake()->unique()->safeEmail(),

            'send_newsletter' => fake()->boolean(),
        ];
    }
}

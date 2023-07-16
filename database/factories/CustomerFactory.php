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
            'customer_last_name' => strtoupper($this->faker->lastName()),
            'customer_first_name' => $this->faker->firstName(),
            'company_name' => $this->faker->company(),

            'address_street' => $this->faker->streetName(),
            'address_number' => $this->faker->buildingNumber(),
            'address_country' => $this->faker->countryCode('alpha-2'),
            'address_postal_code' => $this->faker->postcode(),
            'address_place' => strtoupper($this->faker->city()),

            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),

            'send_newsletter' => $this->faker->boolean(),
        ];
    }
}

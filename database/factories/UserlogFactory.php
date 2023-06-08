<?php

namespace Database\Factories;

use App\Models\Userlog;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Userlog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'country_name' => $this->faker->country(),
            'country_code' => $this->faker->countryCode('alpha-2'),
            'created_at' => $this->faker->dateTimeBetween('-1 years', '-1 days', 'Europe/Brussels')->format('Y-m-d H:i:s'),
        ];
    }
}

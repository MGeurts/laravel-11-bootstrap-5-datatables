<?php

namespace Database\Factories;

use App\Models\Customer;
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
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Nok;
use Illuminate\Database\Eloquent\Factories\Factory;

class NokFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nok::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'staff_id' => 1,
            'phone' => 1232213342,
            'address' => $this->faker->streetAddress,
            'suburb' => $this->faker->state,
            'city' => $this->faker->city,
        ];
    }
}

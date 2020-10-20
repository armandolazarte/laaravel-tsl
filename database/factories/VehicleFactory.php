<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rego' => $this->faker->userName . $this->faker->randomElement(['a', 'v', 'x', 's', 'w', 'd', 'n', 'z', 'b', 'c', 'd', 'e', 'f', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'zz', 'bb', 'cc', 'dd', 'ee', 'ff', 'gg', 'hh', 'ii', '99', '88', '44', '55', 'ww', 'qq']) .
                $this->faker->randomElement(['a', 'v', 'x', 's', 'w', 'd', 'n', 'z', 'b', 'c', 'd', 'e', 'f', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'zz', 'bb', 'cc', 'dd', 'ee', 'ff', 'gg', 'hh', 'ii', '99', '88', '44', '55', 'ww', 'qq']) .
                $this->faker->randomElement(['a', 'v', 'x', 's', 'w', 'd', 'n', 'z', 'b', 'c', 'd', 'e', 'f', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'zz', 'bb', 'cc', 'dd', 'ee', 'ff', 'gg', 'hh', 'ii', '99', '88', '44', '55', 'ww', 'qq']),
            'make' => $this->faker->randomElement(['Honda', 'Toyota', 'Mitsubishi', 'Mercedes', 'Audi', 'Hyundai']),
            'model' => $this->faker->randomElement(['Truck', 'Trailer', 'Mega Truck', 'Mega Trailer', 'Hauler', 'Mega Hauler']),

        ];
    }
}

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
            'rego' => $this->faker->userName,
            'make' => $this->faker->randomElement(['Honda', 'Toyota', 'Mitsubishi', 'Mercedes', 'Audi', 'Hyundai']),
            'model' => $this->faker->randomElement(['Truck', 'Trailer', 'Mega Truck', 'Mega Trailer', 'Hauler', 'Mega Hauler']),
            'vin' => $this->faker->swiftBicNumber,
            'verified' => 0,

            //AXLE SPACING
            'front_a1' => $this->faker->numberBetween(1000, 1500),
            'front_coupling_axle' => $this->faker->numberBetween(1500, 2000),
            'front_coupling_a1' => $this->faker->numberBetween(10000, 11000),
            'a1a2' => $this->faker->numberBetween(1000, 1300),
            'a3a4' => $this->faker->numberBetween(1000, 1300),
            // 'a4a5' => $this->faker->name,
            // 'a5a6' => $this->faker->name,
            // 'a6a7' => $this->faker->name,
            // 'a7a8' => $this->faker->name,
            // 'a8a9' => $this->faker->name,
            // 'a9a10' => $this->faker->name,
            // 'a10a11' => $this->faker->name,
            // 'a11a12' => $this->faker->name,

            //RATINGS
            'gvm' => $this->faker->numberBetween(30000, 31000),
            'gcm' => $this->faker->numberBetween(26000, 28000),
            'faxle_rating' => $this->faker->numberBetween(7000, 8000),
            'raxle_rating' => $this->faker->numberBetween(20000, 21000),
            'front_coupling' => $this->faker->numberBetween(60000, 70000),
            'rear_coupling' => $this->faker->numberBetween(3000, 5000),
            'mtm_braked' => $this->faker->numberBetween(0, 500),
            'mtm_unbraked' => $this->faker->numberBetween(0, 500),

            //TARE WEIGHT
            'kingpin_downforce' => $this->faker->numberBetween(4000,6000),
            'axle1' => $this->faker->numberBetween(9000, 11000),
            'axle2' => $this->faker->numberBetween(8000, 9000),
            'axle3' => $this->faker->numberBetween(8000, 9000),
            // 'axle4' => $this->faker->name,
            // 'axle5' => $this->faker->name,
            // 'axle6' => $this->faker->name,
            // 'axle7' => $this->faker->name,
            // 'axle8' => $this->faker->name,
            // 'axle9' => $this->faker->name,
            // 'axle10' => $this->faker->name,
            // 'axle11' => $this->faker->name,
            // 'axle12' => $this->faker->name,

            //RUCS
            'ruc_weight' => $this->faker->numberBetween(16000, 18000),
            'distance_weight' => $this->faker->numberBetween(15000, 19000),
            'add_weight' => $this->faker->numberBetween(3000, 4000),
            'permit_weight' => $this->faker->numberBetween(40000, 50000),

            //DIMENSIONS
            'wheelbase' => $this->faker->numberBetween(3000, 4000),
            'front_overhang' => $this->faker->numberBetween(1000, 3000),
            'rear_overhang' => $this->faker->numberBetween(1000, 2000),
            'height' => $this->faker->numberBetween(3000, 5000),
            'width' => $this->faker->numberBetween(3000, 4000),
            'forward_dist' => $this->faker->numberBetween(9000, 11000),
            'deck_length' => $this->faker->numberBetween(4000, 5000),
            'an_rear_deck' => $this->faker->numberBetween(3000, 4000),

            //TYRE SIZING
            'tyre_a1' => $this->faker->randomElement(['275/70R22.5', '215/70R22.5', '265/70R22.5', '215/70R25.5']),
            'tyre_a2' => $this->faker->randomElement(['275/70R22.5', '215/70R22.5', '265/70R22.5', '215/70R25.5']),
            'tyre_a3' => $this->faker->randomElement(['275/70R22.5', '215/70R22.5', '265/70R22.5', '215/70R25.5']),
            // 'tyre_a4' => $this->faker->name,
            // 'tyre_a5' => $this->faker->name,
            // 'tyre_a6' => $this->faker->name,
            // 'tyre_a7' => $this->faker->name,
            // 'tyre_a8' => $this->faker->name,
            // 'tyre_a9' => $this->faker->name,
            // 'tyre_a10' => $this->faker->name,
            // 'tyre_a11' => $this->faker->name,
            // 'tyre_a12' => $this->faker->name,


            //AXLE TYPE
            'axle_a1' => $this->faker->randomElement(['S', 'T', '4', '8']),
            'axle_a2' => $this->faker->randomElement(['S', 'T', '4', '8']),
            'axle_a3' => $this->faker->randomElement(['S', 'T', '4', '8']),
            // 'axle_a4' => $this->faker->name,
            // 'axle_a5' => $this->faker->name,
            // 'axle_a6' => $this->faker->name,
            // 'axle_a7' => $this->faker->name,
            // 'axle_a8' => $this->faker->name,
            // 'axle_a9' => $this->faker->name,
            // 'axle_a10' => $this->faker->name,
            // 'axle_a10' => $this->faker->name,
            // 'axle_a12' => $this->faker->name,

            //AXLE SET TYPE
            'axle_set_a1' => $this->faker->randomElement(['In', 'T', 'Tri', 'TS', 'Q']),
            'axle_set_a2' => $this->faker->randomElement(['In', 'T', 'Tri', 'TS', 'Q']),
            'axle_set_a3' => $this->faker->randomElement(['In', 'T', 'Tri', 'TS', 'Q']),

            //SUSPENSION
            'suspension_a1' => $this->faker->randomElement(['Air', 'Leaf']),
            'suspension_a2' => $this->faker->randomElement(['Air', 'Leaf']),
            'suspension_a3' => $this->faker->randomElement(['Air', 'Leaf']),

        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_ref' => $this->faker->numberBetween(100, 200),
            'job_description' => $this->faker->jobTitle,
            'total_cost' => $this->faker->numberBetween(10000, 40000),
            'revenue' => $this->faker->numberBetween(50000, 100000),
        ];
    }
}

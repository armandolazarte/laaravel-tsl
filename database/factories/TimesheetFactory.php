<?php

namespace Database\Factories;

use App\Models\Timesheet;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimesheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timesheet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'staff_id' => $this->faker->randomElement([2, 3, 4, 5]),
            'job_id' => $this->faker->randomElement([2, 3, 4, 5]),
            'started_at' => $this->faker->dateTimeThisMonth(),
            'stopped_at' => $this->faker->dateTimeThisMonth(),
            'morning_break' => $this->faker->randomElement([0, 0.25]),
            'afternoon_break' => $this->faker->randomElement([0, 0.25]),
            'hours' => $this->faker->numberBetween(2, 12),
            'comments' => $this->faker->sentence(1),

        ];
    }
}

<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Payment to ' . $this->faker->name,
            'supplier' => $this->faker->randomElement([1,2,3,5,7,9,11,13,15,12,16,22,44,55,66,33,76,43,79]),
            'amount' => rand(10, 500),
            'status' => Arr::random(['success', 'processing', 'failed']),
            'date' => Carbon::now()->subDays(rand(1, 365))->startOfDay(),
        ];
    }
}

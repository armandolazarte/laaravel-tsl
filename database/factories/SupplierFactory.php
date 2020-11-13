<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'account_number' => $this->faker->bankAccountNumber,
            'email' => $this->faker->safeEmail,
            'contact_name' => $this->faker->name,
            'contact_number' => $this->faker->phoneNumber,
            'street_address' => $this->faker->streetAddress,
            'suburb' => $this->faker->state,
            'city' => $this->faker->city,
        ];
    }
}

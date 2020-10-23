<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(Company::class, 1000)->create()->each(fn ($company) => $company->users()
        //     ->createMany(factory(User::class, 50)->make()->map->getAttributes())
        // );
        // \App\Models\Company::factory(10)->create()->each(fn ($company) => $company->users()
        //     ->createMany(\App\Models\User::factory(5))->make()->map->getAttributes());

        Company::factory(50)
            ->has(User::factory()->count(5))
            ->create();
        //\App\Models\Vehicle::factory(100000)->create();
    }
}

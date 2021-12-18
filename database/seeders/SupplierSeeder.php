<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\supplier;
use App\Models\product;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5; $i++) {
            supplier::create([
                'name' => $faker->name,
                'address' => $faker->streetAddress,
                'phonenumber' => $faker->phoneNumber
            ]);
            product::create([
                'name' => $faker->name,
                'quantity' => $faker->randomDigit,
                'base_price' => $faker->randomFloat(1, 20, 30),
                'price' => $faker->randomFloat(1, 20, 30)

            ]);
        }
    }
}

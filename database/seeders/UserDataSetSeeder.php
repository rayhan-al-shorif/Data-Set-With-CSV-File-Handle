<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserDataSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $limit = 200;
        for ($index = 0; $index < $limit; $index++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make($faker->password),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'remember_token' => Str::random(10),
            ]);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '01323232323',
            'address' => 'Dhaka',
            'remember_token' => Str::random(10),
        ]);
    }
}

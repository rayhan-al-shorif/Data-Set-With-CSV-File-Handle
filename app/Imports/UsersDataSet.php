<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;


class UsersDataSet implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $length = count($rows);
        $faker = \Faker\Factory::create();
        for ($index = 2; $index < $length; $index++) {
            if ($rows[$index][1] != null) {
                User::create([
                    'name' => $rows[$index][1],
                    'email' => $rows[$index][2],
                    'password' => Hash::make($faker->password),
                    'phone' => $rows[$index][3],
                    'address' => $rows[$index][4],
                ]);
            }
        }
    }
}

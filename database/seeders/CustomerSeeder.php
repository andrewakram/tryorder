<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 11; $i++) {
            if (!Customer::where('email', "customer_$i@gmail.com")->first()) {
                Customer::create([
                    'name' => "customer_$i",
                    'email' => "customer_$i@gmail.com",
                    'password' => '123456',
                    'email_verified_at' => Carbon::now(),
                ]);
            }
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Admin::where('phone', '123456789')->first()) {
            Admin::create([
                'name' => 'admin',
                'phone' => '123456789',
                'email' => 'admin@gmail.com',
                'password' => '123456',
                'email_verified_at' => Carbon::now(),
            ]);
        }
    }
}

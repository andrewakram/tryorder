<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'vendor@gmail.com')->first()) {
            User::create([
                'name' => 'vendor 1',
                'email' => 'vendor@gmail.com',
                'password' => '123456',
                'email_verified_at' => Carbon::now(),
            ]);
        }
    }
}

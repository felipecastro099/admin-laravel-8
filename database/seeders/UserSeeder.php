<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $felipe = User::create([
            'name' => 'Felipe Castro',
            'email' => 'engfelipecastro@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('senha')
        ]);

        $yuri = User::create([
            'name' => 'Yuri Canuto',
            'email' => 'yuriasc@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123')
        ]);

        $felipe->assignRole('root');
        $yuri->assignRole('root');
    }
}

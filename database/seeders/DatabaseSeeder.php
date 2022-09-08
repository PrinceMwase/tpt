<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'agent@gmail.com',
            'role_id' => 3,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10)
            ]);

        DB::table('roles')->insert([
            'role' => 'admin'
            ]);
        DB::table('roles')->insert([
            'role' => 'customer'
            ]);
        DB::table('roles')->insert([
            'role' => 'agent'
            ]);

    }
}

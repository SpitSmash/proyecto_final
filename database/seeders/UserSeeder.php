<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.es',
            'password' => bcrypt('123456789'),
        ])->assignRole('admin');

        User::create([
            'name' => 'test',
            'email' => 'test@test.es',
            'password' => bcrypt('123456789'),
        ])->assignRole('client');

        User::create([
            'name' => 'test2',
            'email' => 'test2@test2.es',
            'password' => bcrypt('123456789'),
        ])->assignRole('client');
    }
}

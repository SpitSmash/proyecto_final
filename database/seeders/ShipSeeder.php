<?php

namespace Database\Seeders;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<11; $i++){
            // $id = rand(1, 4);
            
            DB::table('ships')->insert([
                'name' => $faker->name,
                'description' => $faker->paragraph(),
                'type' => $faker->name,
                'status' => $faker->name,
                'image' =>'carImages/alfaromeo-giulia.png',
            ]);
        }
    }
}

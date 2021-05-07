<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        DB::table('user_roles')->insert([
            ['role' => 'learner'],
            ['role' => 'author'],
            ['role' => 'superuser'],
            ['role' => 'administrator'],
        ]);
        DB::table('Users')->insert([
            'name' => 'a',
            'email' => 'khuuthuyky123@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 4,
            
        ]);
        for ($i = 0; $i < 99; $i += 1) {
            $email = $faker->email;
            DB::table('Users')->insert([
                'name' => $faker->name,
                'email' => $email,
                'password' => Hash::make('12345678'),
                'role_id' => $faker->numberBetween(1, 3),
               
            ]);
            DB::table('Profiles')->insert([
                'email' => $email,
                'company' => $faker->company,
                'DOB' =>$faker->date('dd/mm/yyyy')
            ]);
        }
    }
}

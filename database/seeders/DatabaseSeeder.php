<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\Gender_Seeder;
use Database\Seeders\Religion_Seeder;
use Database\Seeders\Settings_Seeder;
use Database\Seeders\Blood_Type_Seeder;
use Database\Seeders\Nationality_Seeder;
use Database\Seeders\Specialization_Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            UserSeeder::class,
            Blood_Type_Seeder::class,
            Nationality_Seeder::class,
            Religion_Seeder::class,
            Gender_Seeder::class,
            Specialization_Seeder::class,
            Settings_Seeder::class,
            
        ]);

        
        // \App\Models\User::factory(10)->create();
    }
}

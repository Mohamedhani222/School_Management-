<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            BloodSeeder::class,
            NationalitieSeeder::class,
            ReligionSeeder::class,
            UserSeeder::class,
            SpecializationSeeder::class,
            GenderSeeder::class,
            AllGradesInfoSeedr::class,
            StudentSeeder::class,
        ]);
    }


}

<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my_parents')->delete();

        My_Parent::create([
            'Email'=>fake()->unique()->safeEmail(),
            'Password' => Hash::make('12345678'),
            'Name_Father' =>['en' => 'Ahmed Hani', 'ar' => 'احمد هاني'],
            'National_ID_Father' =>fake()->unique()->numberBetween(0,10),
            'Passport_ID_Father' =>fake()->unique()->numberBetween(0,10),
            'Phone_Father' =>fake()->unique()->numberBetween(0,10),
            'Job_Father' =>fake()->jobTitle(),
            'Religion_Father_id'=> Religion::all()->random()->id,
            'Nationality_Father_id' => Nationalitie::all()->random()->id,
            'Blood_Type_Father_id' =>Blood::all()->random()->id,
            'Address_Father' => fake()->address(),

            'Name_Mother' =>['en' => 'nancy Hani', 'ar' => 'نانسي هاني'],
            'National_ID_Mother' =>fake()->unique()->numberBetween(0,10),
            'Passport_ID_Mother' =>fake()->unique()->numberBetween(0,10),
            'Phone_Mother' =>fake()->unique()->numberBetween(0,10),
            'Job_Mother' =>fake()->jobTitle(),
            'Religion_Mother_id'=> Religion::all()->random()->id,
            'Nationality_Mother_id' => Nationalitie::all()->random()->id,
            'Blood_Type_Mother_id' =>Blood::all()->random()->id ,
            'Address_Mother' => fake()->address()
        ]);

    }
}

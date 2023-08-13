<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{


    public function run(): void
    {
        DB::table('students')->delete();

        $blood_ids = Blood::pluck('id');
        $nationalitie_ids = Nationalitie::pluck('id');
        $parent_ids = My_Parent::pluck('id');
        $Grade_ids = Grade::pluck('id');
        $names = [

            [
                'en' => 'ahmed mohammed',
                'ar' => 'احمد محمد'
            ],
            [
                'en' => 'Mohammed Hani',
                'ar' => '  محمد هاني'
            ],
            [
                'en' => 'Mostafa Ahmed',
                'ar' => 'مصطفي احمد'
            ],
            [
                'en' => 'Ali Hassan',
                'ar' => 'علي حسن'
            ],
            [
                'en' => 'Lina Khalid',
                'ar' => 'لينا خالد'
            ],
            [
                'en' => 'Yara Ahmed',
                'ar' => 'يارا احمد'
            ],
            [
                'en' => 'Khaled Mohammed',
                'ar' => 'خالد محمد'
            ],
            [
                'en' => 'Sara Abdulaziz',
                'ar' => 'سارة عبدالعزيز'
            ],
            [
                'en' => 'Omar Nasser',
                'ar' => 'عمر ناصر'
            ],
            [
                'en' => 'Maya Saleh',
                'ar' => 'مايا صالح'
            ],
            [
                'en' => 'Ahmed Khalifa',
                'ar' => 'احمد خليفة'
            ],
            [
                'en' => 'Nada Ali',
                'ar' => 'ندى علي'
            ],
            [
                'en' => 'Yusuf Hamza',
                'ar' => 'يوسف حمزة'
            ],
            [
                'en' => 'Sarah Smith',
                'ar' => 'سارة سميث'
            ],
            [
                'en' => 'Layla Hassan',
                'ar' => 'ليلى حسن'
            ],
            [
                'en' => 'Omar Abdullah',
                'ar' => 'عمر عبدالله'
            ],
            [
                'en' => 'Aya Khalid',
                'ar' => 'آية خالد'
            ],
            [
                'en' => 'Fatima Ali',
                'ar' => 'فاطمة علي'
            ],
            [
                'en' => 'Youssef Ahmed',
                'ar' => 'يوسف احمد'
            ],
            [
                'en' => 'Nour Saleh',
                'ar' => 'نور صالح'
            ]


        ];




        $ac_years = [
            date("Y"),
            date("Y", strtotime("+1 years")),
            date("Y", strtotime("+2 years")),
        ];




        foreach ($names as $name) {
            $g_id = $Grade_ids->random();
            $grade_classes_id = Classroom::where('Grade_id', $g_id)->pluck('id')->unique()->random();
            $sections_class = Section::where('Classroom_id' , $grade_classes_id)->pluck('id')->unique()->random();

            Student::create([
                'name' => $name,
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('12345678'),
                'gender_id' => Gender::first()->id,
                'blood_id' => $blood_ids->random(),
                'Grade_id' => $g_id,
                'Classroom_id' => $grade_classes_id,
                'section_id' => $sections_class,
                'nationalitie_id' => $nationalitie_ids->random(),
                'parent_id' => $parent_ids->random(),
                'Date_Birth' => fake()->date(),
                'academic_year' => $ac_years[rand(0, 1)]
            ]);

        }



    }
}

<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllGradesInfoSeedr extends Seeder

{
    public function run(): void
    {
        DB::table('sections')->delete();
        DB::table('classrooms')->delete();
        DB::table('grades')->delete();

        $grades = [
            [
                'en' => 'Primary Stage',
                'ar' => 'المرحلة الابتدائية',
            ],
            [
                'en' => 'Middle Stage',
                'ar' => 'المرحلة المتوسطة',
            ],
            [
                'en' => 'High School',
                'ar' => 'المرحلة الثانوية',
            ],
        ];
        $classrooms = [
            [
                'en' => 'Classroom 101',
                'ar' => 'الفصل ١٠١',
            ],
            [
                'en' => 'Classroom 202',
                'ar' => 'الفصل ٢٠٢',
            ],
            [
                'en' => 'Classroom 303',
                'ar' => 'الفصل ٣٠٣',
            ],
            [
                'en' => 'Classroom 404',
                'ar' => 'الفصل ٤٠٤',
            ],
            [
                'en' => 'Classroom 505',
                'ar' => 'الفصل ٥٠٥',
            ],
        ];
        $sections = [

            ['en' => 'Section A', 'ar' => 'القسم أ'],
            ['en' => 'Section B', 'ar' => 'القسم ب'],
            ['en' => 'Section C', 'ar' => 'القسم ج'],
            ['en' => 'Section D', 'ar' => 'القسم د'],

        ];

        foreach ($grades as $name) {
            $grade = new Grade();
            $grade->Name = $name;
            $grade->save();

            foreach ($classrooms as $classroom) {
                $class = new Classroom();
                $class->Name_class = $classroom;
                $class->Grade_id = $grade->id;
                $class->save();
                foreach ($sections as $section) {
                    Section::create([
                        'Name_section' => $section,
                        'Grade_id' => $grade->id,
                        'Classroom_id' => $class->id,
                        'Status' => 1
                    ]);
                }

            }


        }


    }
}

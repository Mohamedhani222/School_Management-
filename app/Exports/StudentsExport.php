<?php

namespace App\Exports;

use App\Models\Blood;
use App\Models\Gender;
use App\Models\Nationalitie;
use App\Models\Student;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $lang = App::getLocale();
        $students = Student::all()->map(function ($student) use ($lang) {
            return [
                'id' => $student->id,
                'name' => $student->getTranslation('name', $lang),
                'email' =>$student->email,
                'gender' =>$student->gender->getTranslation('Name', $lang),
                'blood' =>Blood::find($student->blood_id)->blood_type,
                'nationalitie' =>Nationalitie::find($student->nationalitie_id)->getTranslation('Name', $lang),

            ];
        });
        return $students;

    }

    public function headings(): array
    {
        $columns = [
            'id',
            'name',
            'email',
            'gender',
            'blood',
            'nationalitie'

        ];

        return $columns;
    }


}

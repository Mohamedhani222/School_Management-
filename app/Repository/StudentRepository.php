<?php

namespace App\Repository;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Teacher;
use App\Repository\TeacherRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class StudentRepository implements StudentRepositoryInterface
{

    public function Get_Students()
    {
        $students =Student::all();
        return view('pages.Students.index' , compact('students'));
    }
    public function Create_Student()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Blood::all();

        return view('pages.Students.add', $data);
    }
    public function Edit_Student($id)
    {
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = Blood::all();
        $data['Students'] = Student::findorFail($id);
        return view('pages.Students.edit' , $data);
    }

    public function Store_Student($request)
    {
            $student = new Student();
            $student->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->gender_id = $request->gender_id;
            $student->nationalitie_id = $request->nationalitie_id;
            $student->blood_id = $request->blood_id;
            $student->Date_Birth = $request->Date_Birth;
            $student->Grade_id = $request->Grade_id;
            $student->Classroom_id = $request->Classroom_id;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            $student->save();

    }

    public function Update_Student($request)
    {
        $student = Student::findorFail($request->id);
        $student->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->gender_id = $request->gender_id;
        $student->nationalitie_id = $request->nationalitie_id;
        $student->blood_id = $request->blood_id;
        $student->Date_Birth = $request->Date_Birth;
        $student->Grade_id = $request->Grade_id;
        $student->Classroom_id = $request->Classroom_id;
        $student->section_id = $request->section_id;
        $student->parent_id = $request->parent_id;
        $student->academic_year = $request->academic_year;
        $student->save();

    }
    public function Delete_Student($request){
        Student::findorFail($request->id)->delete();
    }
    public function Get_classrooms($id)
    {
        $list_classes = Classroom::where('Grade_id', $id)->pluck("Name_class", 'id');
        return $list_classes;

    }
    public function Get_sections($id){
        $list_sections = Section::where('Classroom_id', $id)->pluck("Name_section", 'id');
        return $list_sections;

    }
}

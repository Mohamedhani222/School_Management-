<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Repository\TeacherRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function StoreTeacher($request)
    {
        try {
            $Teachers = new Teacher();
            $Teachers->Email = $request->Email;
            $Teachers->Password = Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Join_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function UpdateTeacher($request)
    {
        try {
            $Teachers = Teacher::findorFail($request->id);
            $Teachers->Email = $request->Email;
            $Teachers->Password = Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Join_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function DeleteTeachers($request)
    {
        Teacher::findOrFail($request->id)->delete();
    }

    public function EditTeacher($id)
    {
        return Teacher::findorFail($id);
    }

    public function getSpecialization()
    {
        return Specialization::all();
    }

    public function getGenders()
    {
        return Gender::all();
    }


}

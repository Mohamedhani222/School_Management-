<?php

namespace App\Repository;

use App\interfaces\GraduatedRepositoryInterface;
use App\Models\Grade;
use App\Models\Student;

class GraduatedRepository implements GraduatedRepositoryInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();

        return view('pages.Students.Graduated.index', compact('students'));

    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create', compact('Grades'));
    }

    public function softDelete($request)
    {
        try {
            $students = Student::where([
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
            ])->get();

            foreach ($students as $student) {
                $student->delete();
            }
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error_Graduated' => $e->getMessage()]);
        }

    }


    public function update($request)
    {
        try {
            Student::withTrashed()
                ->where('id', $request->id)
                ->restore();

            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();

        }
    }


    public function destroy($request)
    {
        try {
            Student::onlyTrashed()
                ->where('id', $request->id)->forceDelete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();

        }

    }


}

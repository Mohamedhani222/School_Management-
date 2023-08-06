<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\interfaces\TeacherRepositoryInterface;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public $Teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->Teacher = $teacher;
    }

    public function index()
    {

        $teachers = $this->Teacher->getAllTeachers();

        return view('pages.Teachers.teachers', ['teachers' => $teachers]);

    }

    public function create()
    {
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGenders();
        return view('pages.Teachers.create', compact('specializations', 'genders'));
    }

    public function store(StoreTeachers $request)
    {
        $this->Teacher->StoreTeacher($request);
        toastr()->success(trans('messages.success'));
        return redirect()->route('teachers.create');
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit($id)
    {
        $Teachers = $this->Teacher->EditTeacher($id);
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGenders();
        return view('pages.Teachers.Edit', compact('specializations', 'genders','Teachers'));
    }

    public function update(Request $request)
    {
        $this->Teacher->UpdateTeacher($request);
        toastr()->success(trans('messages.success'));
        return redirect()->route('teachers.index');

    }

    public function destroy(Request $r)
    {
        $this->Teacher->DeleteTeachers($r);

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('teachers.index');
    }
}

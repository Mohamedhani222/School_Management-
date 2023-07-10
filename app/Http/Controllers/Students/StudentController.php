<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentsRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }


    public function index()
    {
        return $this->student->Get_Students();
    }

    public function create()
    {
        return $this->student->Create_Student();
    }

    public function store(StoreStudentsRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->student->Store_Student($request);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return $this->student->Edit_Student($id);
    }


    public function update(StoreStudentsRequest $request)
    {
        try {
            $this->student->Update_Student($request);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('students.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        try {
            $this->student->Delete_Student($request);
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('students.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Get_classrooms($id)
    {
        return $this->student->Get_classrooms($id);
    }

    public function Get_sections($id)
    {
        return $this->student->Get_sections($id);

    }
}

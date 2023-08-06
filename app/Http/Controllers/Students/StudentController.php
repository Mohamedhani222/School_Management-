<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\StoreStudentsRequest;
use App\interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;

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
        return $this->student->Show_Student($id);
    }


    public function add_attachment(ImageRequest $request)
    {
        try {
            $this->student->add_attachment($request);
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.show', $request->student_id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit(string $id)
    {
        return $this->student->Edit_Student($id);
    }

    public function export_students()
    {
        try {
            return $this->student->export_students();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }

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

    public function download_attachment($studentsname, $filename)
    {

        return $this->student->download_attachment($studentsname, $filename);
    }

    public function delete_attachment(Request $request)
    {
        return $this->student->delete_attachment($request);
    }
}

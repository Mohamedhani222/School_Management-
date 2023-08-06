<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeStoreRequest;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.grades', compact('grades'));
    }

    public function create()
    {
        //
    }



    public function store(GradeStoreRequest $request)
    {

//        if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {
//            return redirect()->back()->withErrors(['error' => 'هذا الحقل موجود بالفعل']);
//        }


        try {

            $request->validated();
            Grade::create([
                'Name' => ['ar' => $request->Name, 'en' => $request->Name_en],
                'Notes' => $request->Notes
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('grades.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Grade $grade)
    {
        //
    }

    public function edit(Grade $grade)
    {
        //
    }

    public function update(GradeStoreRequest $request)
    {
//        $ex = Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en);
//        if ($ex->exists() and $request->id != $ex->pluck('id')) {
//            return redirect()->back()->withErrors(['error' => 'هذا الحقل موجود بالفعل']);
//        }

        try {
            $grade = Grade::find($request->id);
            $request->validated();
            $grade->update([
                'Name' => ['ar' => $request->Name, 'en' => $request->Name_en],
                'Notes' => $request->Notes
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       $grade= Grade::findorFail($request->id);
        if (count($grade->classrooms) > 0){
            toastr()->error(trans('grades_trans.classes_warning'));
            return redirect()->route('grades.index');
        }
        $grade->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('grades.index');
    }
}

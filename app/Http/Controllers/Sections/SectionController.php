<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeSectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Sections.sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeSectionRequest $request)
    {
        try {
            $section = new Section();
            $section->Name_section = ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar];
            $section->Grade_id = $request->Grade_id;
            $section->Classroom_id = $request->Class_id;
            $section->Status = 1;
            $section->save();
            $section->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(storeSectionRequest $request)
    {
        $status = '';
        if ($request->Status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        try {
            $section = Section::findorFail($request->id);
            $section->update([
                'Name_section' => ['en' => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar],
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Class_id,
                'Status' => $status

            ]);

            // تعديل المدرسين للسكشن
            if (isset($request->teacher_id)){
                $section->teachers()->sync($request->teacher_id);
            }else {
                $section->teachers()->sync(array());
            }


            toastr()->success(trans('messages.Update'));
            return redirect()->back();

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Section::findorFail($request->id)->delete();
        toastr()->success(trans('messages.success'));
        return redirect()->back();

    }

    public function getclasses($id)
    {
        return Classroom::where("Grade_id", $id)->pluck("Name_class", 'id');
    }


}

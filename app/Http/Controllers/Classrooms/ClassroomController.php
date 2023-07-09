<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassStoreRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    public function index()
    {
        $My_Classes = Classroom::all();
        $grades = Grade::all();
        return view('pages.Classes.classes', compact('My_Classes', 'grades'));
    }


    public function create()
    {
        //
    }


    public function store(ClassStoreRequest $request)
    {
        $classes = $request->List_Classes;

        try {
            $request->validated();
            foreach ($classes as $class) {
                Classroom::create([
                    'Name_class' => ['en' => $class['Name_class_en'], 'ar' => $class['Name']],
                    'Grade_id' => $class['Grade_id']
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }


    }

    public function deleteAll(Request $request)
    {
        $ids = explode(',', $request->delete_all_id);

        Classroom::whereIn('id', $ids)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();

    }


    public function show(Classroom $classroom)
    {
        //
    }


    public function edit(Classroom $classroom)
    {
        //
    }


    public function update(Request $request)
    {
        try {
            $class = Classroom::findorFail($request->id);
            $class->update([
                'Name_class' => ['ar' => $request->Name, 'en' => $request->Name_en],
                'Grade_id' => $request->Grade_id
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
        }

    }


    public function destroy(Request $request)
    {
        Classroom::findorFail($request->id)->delete();
        toastr()->success(trans('messages.success'));
        return redirect()->back();

    }

    public function Filter_Classes(Request $request)
    {
        $grades =Grade::all();
        $search = Classroom::select('*')->where('Grade_id', $request->Grade_id)->get();
        return view('pages.Classes.classes', compact( 'grades'))->withDetails($search);

    }

}

<?php

namespace App\Repository;
use App\interfaces\StudentPromotionRepositoryInterface;
use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{
    public function index()
    {

        $Grades = Grade::all();
        return view('pages.Students.promotions.index', compact('Grades'));


    }

    public function create()
    {
        $Promotions = promotion::all();
        return view('pages.Students.promotions.management', compact('Promotions'));

    }


    public function store($request)
    {
        try {
            DB::beginTransaction();
            $students = Student::where([
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'academic_year' => $request->academic_year
            ])->get();

            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __(trans('students_trans.no_data')));
            }

//            if ($request->Grade_id == $request->Grade_id_new &&
//                $request->Classroom_id == $request->Classroom_id_new &&
//                $request->section_id == $request->section_id_new) {
//                return redirect()->back()->with('error_promotions', __(trans('students_trans.promotion_error')));
//            }

            foreach ($students as $student) {
                // (1) update student info
                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)
                    ->update([
                        'Grade_id' => $request->Grade_id_new,
                        'Classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new
                    ]);


                // (2) insert into promotion
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_class' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_class' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            // if 2 process done commit in database
            DB::commit();
            flash(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($request)
    {
        try {
            DB::beginTransaction();
            if ($request->page_id == 1) {
                $promotions = promotion::all();

                foreach ($promotions as $promotion) {

                    // bad practice, but it work
//                    $ids = explode(',', $promotion->student_id);
//                    Student::whereIn('id', $ids)->update([

                    Student::whereIn('id', promotion::select('student_id'))->update([
                        'Grade_id' => $promotion->from_grade,
                        'Classroom_id' => $promotion->from_class,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year,
                    ]);

                }

                DB::table('promotions')->delete();
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }else{
                $por =promotion::findorFail($request->id);
                Student::where('id' , $por->student_id)->update([
                    'Grade_id'=>$por->from_grade,
                    'Classroom_id'=>$por->from_class,
                    'section_id'=> $por->from_section,
                    'academic_year'=>$por->academic_year,
                ]);

                promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }

    }

}

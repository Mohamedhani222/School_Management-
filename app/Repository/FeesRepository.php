<?php

namespace App\Repository;

use App\interfaces\FeesRepositoryInterface;
use App\Models\Fee;
use App\Models\Grade;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {
        $fees = Fee::get();
        return view('pages.Fees.index')->with(['fees' => $fees]);
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Fees.add')->with(['Grades' => $Grades]);
    }

    public function store($request, $data)
    {
        try {
            $data['title'] = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $data = array_slice($data, 2);
            Fee::create($data);
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $fee = Fee::findorFail($id);
        $Grades = Grade::all();

        return view('pages.Fees.edit')->with(['fee' => $fee, 'Grades' => $Grades]);

    }

    public function update($request, $data)
    {
        try {
            $data['title'] = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $data = array_slice($data, 2);

            Fee::findorFail($request->id)
                ->update($data);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('fees.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        try {
            Fee::findorFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}

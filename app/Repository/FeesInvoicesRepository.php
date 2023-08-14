<?php

namespace App\Repository;

use App\interfaces\FeesInvoicesRepositoryInterface;
use App\Models\Fee;
use App\Models\FeeInvoices;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function Symfony\Component\String\s;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{

    public function index(): View
    {
        $Fee_invoices = FeeInvoices::all();
        $Grades = Grade::all();
        return view('pages.Fees_Invoices.index', compact('Fee_invoices', 'Grades'));

    }

    public function show($id)
    {
        $student = Student::findorFail($id);
        $fees = Fee::where('Classroom_id', $student->Classroom_id)->get();

        return view('pages.Fees_Invoices.add', compact('fees', 'student'));

    }

    public function store($request)
    {
        $List_Fees = $request->List_Fees;
        DB::beginTransaction();
        try {
            foreach ($List_Fees as $list_Fee) {
                $amount = Fee::findorFail($list_Fee['fee_id'])->amount;
                $fee = FeeInvoices::create([
                    'date' => date('Y-m-d'),
                    'student_id' => $list_Fee['student_id'],
                    'Grade_id' => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id,
                    'fee_id' => $list_Fee['fee_id'],
                    'amount' => $amount,
                    'notes' => $list_Fee['description']
                ]);

                StudentAccount::create([
                    'student_id' => $list_Fee['student_id'],
                    'type' => 'invoice',
                    'fee_invoice_id' => $fee->id,
                    'Debit' => $amount,
                    'Credit' => 0.00,
                    'notes' => $list_Fee['description']
                ]);

            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('invoices.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee_invoices = FeeInvoices::findorFail($id);
        $fees = Fee::where('Classroom_id', $fee_invoices->Classroom_id)->get();

        return view('pages.Fees_Invoices.edit', compact('fee_invoices', 'fees'));


    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $fee = Fee::findorFail($request->fee_id);
            $fee_invoices = FeeInvoices::findorFail($request->id);
            $fee_invoices->update([
                'fee_id' => $request->fee_id,
                'notes' => $request->description,
                'amount' => $fee->amount
            ]);

            StudentAccount::where('fee_invoice_id', $fee_invoices->id)->update([
                'Debit' => $fee->amount,
                'notes' => $request->description
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('invoices.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function destroy($request)
    {
        try {
            FeeInvoices::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}

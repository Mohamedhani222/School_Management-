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
                FeeInvoices::create([
                    'date' => date('Y-m-d'),
                    'student_id' => $list_Fee['student_id'],
                    'Grade_id' => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id,
                    'fee_id' => $list_Fee['fee_id'],
                    'amount' => $list_Fee['amount_id'],
                    'notes' => $list_Fee['description']
                ]);

                StudentAccount::create([
                    'student_id' => $list_Fee['student_id'],
                    'type' => 'invoice',
                    'fee_invoice_id' => $list_Fee['fee_id'],
                    'Debit' => $list_Fee['amount_id'],
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
        // TODO: Implement edit() method.
    }

    public function update($request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}

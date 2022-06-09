<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;
use App\Models\FundAccount;
use App\Models\Nationality;
use App\Models\StudentAccount;
use App\Models\StudentReceipt;
use Illuminate\Support\Facades\DB;


 class StudentsReceiptRepository implements StudentsReceiptRepository_Interface {

  
    public function index()
    {
        $students_receipt = StudentReceipt::all();

        return view('pages.students.receipt.index',compact('students_receipt'));
    }




    public function store($request)
    {
        DB::beginTransaction();

        try {
         
          $students_receipt = new StudentReceipt();
          $students_receipt->date = date('Y-m-d');
          $students_receipt->student_id = $request->student_id;
          $students_receipt->debt = $request->Debit;
          $students_receipt->description = $request->description;
          $students_receipt->save();

          $fund_accounts = new FundAccount();
          $fund_accounts->date = date('Y-m-d');
          $fund_accounts->receipt_id = $students_receipt->id;
          $fund_accounts->debt = $request->Debit;
          $fund_accounts->credit = 0.00;
          $fund_accounts->description = $request->description;
          $fund_accounts->save();

          $student_accounts = new StudentAccount();
          $student_accounts->date = date('Y-m-d');
          $student_accounts->type = 'receipt';
          $student_accounts->receipt_id = $students_receipt->id;
          $student_accounts->student_id = $request->student_id;
          $student_accounts->debt = 0.00;
          $student_accounts->credit = $request->Debit;
          $student_accounts->description = $request->description;
          $student_accounts->save();

        DB::commit();

        toastr()->success(trans('messages.success'));
        return redirect()->route('students_receipt.index');

           
        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.students.receipt.add', compact('student'));
 
    }


    public function edit($id)
    {

        $students_receipt = StudentReceipt::findOrFail($id);

      
        return view('pages.students.receipt.edit',compact('students_receipt'));

    }

    public function update($request)
    {
      
        DB::beginTransaction();

        try {
         

        $students_receipt = StudentReceipt::findOrFail($request->id);
        $students_receipt->update([
            'date' => date('Y-m-d'),
            'student_id' => $request->student_id,
            'debt' => $request->Debit,
            'description' => $request->description,
        ]);

        $fund_accounts = FundAccount::where('receipt_id', $request->id);
        $fund_accounts->update([
            'date' =>  date('Y-m-d'),
            'receipt_id' =>  $students_receipt->id,
            'debt' => $request->Debit,
            'credit' => 0.00,
            'description' => $request->description,
        ]);

        $student_accounts = StudentAccount::where('receipt_id', $request->id);
        $student_accounts->update([
            'date' => date('Y-m-d'),
            'type' => 'receipt',
            'receipt_id' => $students_receipt->id,
            'student_id' => $request->student_id,
            'debt' => 0.00,
            'credit' => $request->Debit,
            'description' => $request->description,
        ]);
        
        DB::commit();

        toastr()->info(trans('messages.update'));
        return redirect()->route('students_receipt.index');

           
        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
      
    }


    public function destroy($request)
    {
        
        StudentReceipt::destroy($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->back();
    }


   
  

 }



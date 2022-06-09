<?php

namespace App\Repository;

use App\Models\Fees;
use App\Models\Student;
use App\Models\FeeInvoice;
use App\Models\Nationality;
use App\Models\SudentAccount;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;


 class FeesInvoicesRepository implements FeesInvoicesRepository_Interface {

  
  
    public function index()
    {
        $students = Student::all();
        $nationalities = Nationality::all();
        $fees_invoices = FeeInvoice::all();
        return view('pages.students.fees_invoices.index',compact('students', 'nationalities', 'fees_invoices'));
    }


    public function show($id)
    {
        $students = Student::findOrFail($id);

        $fees = Fees::where('Classroom_id', $students->Classroom_id)->get();

        return view('pages.students.fees_invoices.add_invoice', compact('students', 'fees'));
    }


    public function store($request)
    {

      $List_Fees = $request->List_Fees; 

      $request->validate([
        'List_Fees.*.student_id' => 'required',
        'List_Fees.*.fee_id' => 'required',
        'List_Fees.*.amount' => 'required',
        'List_Fees.*.Grade_id' => 'required',
        'List_Fees.*.Classroom_id' => 'required',
      ],[
        'List_Fees.*.student_id.required' => trans('Accounts.student_name_required'),
        'List_Fees.*.fee_id.required' => trans('Accounts.fee_kind_required'),
        'List_Fees.*.amount.required' => trans('Accounts.amount_required'),
        'List_Fees.*.Grade_id.required' => trans('Accounts.grade_required'),
        'List_Fees.*.Classroom_id.required' => trans('Accounts.class_name_required'),
      ]);
       

        DB::beginTransaction();
        
        try {
         
        
      foreach ($List_Fees as $list_fees) {
          
        $fees_invoices = new FeeInvoice();
        $fees_invoices->create([
            'invoice_date' => date('Y-m-d'),
            'student_id' => $list_fees['student_id'],
            'fee_id' => $list_fees['fee_id'],
            'amount' => $list_fees['amount'],
            'description' => $list_fees['description'],
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
        ]);

        $student_account = new StudentAccount();
        $student_account->create([
            'date' =>  date('Y-m-d'),
            'type' => 'invoice',
            'student_id' => $list_fees['student_id'],
            'debt' => $list_fees['amount'],
            'credit' => '0.00',
            'description' => $list_fees['description'],
        ]);
      }

     DB::commit();

     toastr()->success(trans('messages.success')); 
     return redirect()->back();
        
    } catch (\Throwable $th) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $th->getMessage()]);
    }

     
    }


    public function edit($id)
    {
        $fee_invoices = FeeInvoice::findorfail($id);
        $fees = Fees::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.students.fees_invoices.edit',compact('fee_invoices','fees'));
    }   

   
    public function update($request, $id)
    {
      
        $request->validate([
            'List_Fees.*.student_id' => 'required',
            'List_Fees.*.fee_id' => 'required',
            'List_Fees.*.amount' => 'required',
            'List_Fees.*.Grade_id' => 'required',
            'List_Fees.*.Classroom_id' => 'required',
          ],[
            'List_Fees.*.student_id.required' => trans('Accounts.student_name_required'),
            'List_Fees.*.fee_id.required' => trans('Accounts.fee_kind_required'),
            'List_Fees.*.amount.required' => trans('Accounts.amount_required'),
            'List_Fees.*.Grade_id.required' => trans('Accounts.grade_required'),
            'List_Fees.*.Classroom_id.required' => trans('Accounts.class_name_required'),
          ]);
           
        
        DB::beginTransaction();
        
        try {
         
        $fees_invoices = FeeInvoice::findorfail($id);
        $fees_invoices->update([
            'fee_id' => $request->fee_id,
            'amount' =>$request->amount,
            'description' => $request->description,
        ]);

        $student_account = SudentAccount::where('fee_invoice_id',$request->id);
        $student_account->update([
            'debt' => $request->amount,
            'description' => $request->description,
        ]);

     DB::commit();

     toastr()->success(trans('messages.success')); 
     return redirect()->back();
        
    } catch (\Throwable $th) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $th->getMessage()]);
    }

     
    }


    public function destroy($id)
    {
      FeeInvoice::destroy($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->back();
    }

    
  

 }



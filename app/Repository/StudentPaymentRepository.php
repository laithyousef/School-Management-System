<?php

namespace App\Repository;

use App\Models\Student;
use App\Models\FundAccount;
use App\Models\FeeProcessing;
use App\Models\StudentAccount;
use App\Models\StudentPayment;
use Illuminate\Support\Facades\DB;


 class StudentPaymentRepository implements StudentPaymentRepository_Interface {

  
    public function index()
    {
        $students_payments = StudentPayment::all();
        return view('pages.students.payments.index',compact('students_payments'));
    }

  


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.payments.add',compact('student'));
    }


      public function store($request)
    {

        DB::beginTransaction();

     try {


     $students_payments = new StudentPayment();
     
     $students_payments->create([
        'date' =>  date('Y-m-d'),
        'student_id' => $request->student_id,
        'amount' => $request->Debt,
        'description' => $request->description,
     ]);

     $fund_accounts = new FundAccount();
     $fund_accounts->create([
        'date' => date('Y-m-d'),
        'payment_id' =>  $students_payments->id,
        'debt' => 0.00 ,
        'credit' => $request->Debt,
        'description' => $request->description
     ]);


     $students_accounts = new StudentAccount();
     $students_accounts->create([
        'date' =>  date('Y-m-d'),
        'type' => 'payment',
        'student_id' => $request->student_id,
        'payment_id' =>  $students_payments->id,
        'debt' =>  $request->Debt,
        'credit' => 0.00 ,
        'description' => $request->description,

     ]);

        DB::commit();
        toastr()->success(trans('messages.success'));
        return redirect()->route('students_payment.index');

        } catch (\Exception $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
     
    }


    public function edit($id){

        $students_payments = StudentPayment::findorfail($id);

        return view('pages.students.payments.edit',compact('students_payments'));

    }

    public function update($request)
    {

        DB::beginTransaction();

        try {
   
   
        $students_payments = StudentPayment::findorfail($request->id);
        
        $students_payments->update([
           'date' =>  date('Y-m-d'),
           'student_id' => $request->student_id,
           'amount' => $request->Debt,
           'description' => $request->description,
        ]);
   
        $fund_accounts = FundAccount::where('payment_id', $request->id);
        $fund_accounts->update([
           'date' => date('Y-m-d'),
           'payment_id' =>  $students_payments->id,
           'debt' => 0.00 ,
           'credit' => $request->Debt,
           'description' => $request->description
        ]);
   
   
        $students_accounts = StudentAccount::where('payment_id', $request->id);
        $students_accounts->update([
           'date' =>  date('Y-m-d'),
           'type' => 'payment',
           'student_id' => $request->student_id,
           'payment_id' =>  $students_payments->id,
           'debt' =>  $request->Debt,
           'credit' => 0.00 ,
           'description' => $request->description,
   
        ]);
   
           DB::commit();
           toastr()->info(trans('messages.update'));
           return redirect()->route('students_payment.index');
   
           } catch (\Exception $th) {
               DB::rollback();
               return redirect()->back()->withErrors(['error' => $th->getMessage()]);
           }
   
    }


    public function destroy($request)
    {
        
        StudentPayment::destroy($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->back();
    }


   
  

 }



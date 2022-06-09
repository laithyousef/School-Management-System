<?php

namespace App\Repository;

use App\Models\Student;
use App\Models\FeeProcessing;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;


 class FeeProcessingRepository implements FeeProcessingRepository_Interface {

  
    public function index()
    {
        $fees_procsssings = FeeProcessing::all();
        return view('pages.students.fees_processings.index',compact('fees_procsssings'));
    }

  


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.fees_processings.add',compact('student'));
    }


      public function store($request)
    {

        $request->validate([
            'Debt' => 'required|numeric',
        ],[
            'Debt.required' => trans('parent_trans.required'),
            'Debt.numeric' => trans('parent_trans.numeric'),
            
        ]);

        DB::beginTransaction();

     try {


     $fees_procsssings = new FeeProcessing();
     
     $fees_procsssings->create([
        'date' =>  date('Y-m-d'),
        'student_id' => $request->student_id,
        'amount' => $request->Debt,
        'description' => $request->description,
     ]);

     $students_accounts = new StudentAccount();
     $students_accounts->create([
        'date' =>  date('Y-m-d'),
        'type' => 'Fee_Processing',
        'student_id' => $request->student_id,
        'processing_id' =>  $fees_procsssings->id,
        'debt' => 0.00 ,
        'credit' =>  $request->Debt,
        'description' => $request->description,

     ]);

        DB::commit();
        toastr()->success(trans('messages.success'));
        return redirect()->route('Fee_Processing.index');

        } catch (\Exception $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
     
    }


    public function edit($id){

        $fees_procsssings = FeeProcessing::findorfail($id);

        return view('pages.students.fees_processings.edit',compact('fees_procsssings'));

    }

    public function update($request)
    {
        $request->validate([
            'Debt' => 'required|numeric',
          
        ],[
            'Debt.required' => trans('parent_trans.required'),
            'Debt.numeric' => trans('parent_trans.numeric'),
           
        ]);

        DB::beginTransaction();

        try {
   
   
        $fees_procsssings = FeeProcessing::findorfail($request->id);
        
        $fees_procsssings->update([
           'date' =>  date('Y-m-d'),
           'student_id' => $request->student_id,
           'amount' => $request->Debt,
           'description' => $request->description,
        ]);
   
        $students_accounts = StudentAccount::where('processing_id', $request->id);
        $students_accounts->update([
           'date' =>  date('Y-m-d'),
           'type' => 'Fee_Processing',
           'student_id' => $request->student_id,
           'processing_id' =>  $fees_procsssings->id,
           'debt' => 0.00 ,
           'credit' =>  $request->Debt,
           'description' => $request->description,
   
        ]);
   
           DB::commit();
           toastr()->info(trans('messages.update'));
           return redirect()->route('Fee_Processing.index');
   
           } catch (\Exception $th) {
               DB::rollback();
               return redirect()->back()->withErrors(['error' => $th->getMessage()]);
           }
        
    }


    public function destroy($request)
    {
        
        FeeProcessing::destroy($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->back();
    }


   
  

 }



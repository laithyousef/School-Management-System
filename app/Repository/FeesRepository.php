<?php

namespace App\Repository;

use App\Models\Fees;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Nationality;


 class FeesRepository implements FeesRepository_Interface {

  
    public function index()
    {
        $fees = Fees::all();
        $nationalities = Nationality::all();
        return view('pages.students.fees.index',compact('fees', 'nationalities'));
    }


    public function create()
    {

      $grades = Grade::all();
        return view('pages.students.fees.create',compact('grades'));
 
    }


    public function store($request)
    {
        $request->validate([
            'title_ar' => 'required|unique:fees,title->ar,id',
            'title_en' => 'required|unique:fees,title->en,id',
            'amount' => 'required|numeric',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'year' => 'required',
            'Fee_type' => 'required',
        ],[
            'title_ar.required' => trans('Accounts.tilte_required'),
            'title_en.required' => trans('Accounts.tilte_required'),
            'amount.required' => trans('Accounts.amount_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Classroom_id.required' => trans('Accounts.class_name_required'),
            'year.required' => trans('Accounts.year_required'),
            'Fee_type.required' => trans('Accounts.fee_kind_required'),
        ]);

     $fees = new Fees();
     
     $fees->create([
        'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
        'amount' => $request->amount,
        'Grade_id' => $request->Grade_id,
        'Classroom_id' => $request->Classroom_id,
        'year' => $request->year,
        'fee_type' =>$request->Fee_type,
        'description' => $request->description,
     ]);

     toastr()->success(trans('messages.success'));
     return redirect()->route('fees.index');
     
    }


    public function show($id)
    {
      
    }


    public function edit($id){

        $fee = Fees::findorfail($id);
        $grades = Grade::all();
        return view('pages.students.fees.edit',compact('fee','grades'));

    }

    public function update($request)
    {
        $request->validate([
            'title_ar' => 'required|unique:fees,title->ar,id',
            'title_en' => 'required|unique:fees,title->en,id',
            'amount' => 'required|numeric',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'year' => 'required',
            'Fee_type' => 'required',
        ],[
            'title_ar.required' => trans('Accounts.tilte_required'),
            'title_en.required' => trans('Accounts.tilte_required'),
            'amount.required' => trans('Accounts.amount_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Classroom_id.required' => trans('Accounts.class_name_required'),
            'year.required' => trans('Accounts.year_required'),
            'Fee_type.required' => trans('Accounts.fee_kind_required'),
        ]);
      
        $fees = Fees::findorfail($request->id);
     
        $fees->update([
           'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
           'amount' => $request->amount,
           'Grade_id' => $request->Grade_id,
           'Classroom_id' => $request->Classroom_id,
           'year' => $request->year,
           'fee_type' => $request->Fee_type,
           'description' => $request->description,
        ]);
   
        toastr()->info(trans('messages.update'));
        return redirect()->route('fees.index');
      
    }


    public function destroy($request)
    {
        
        Fees::destroy($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->back();
    }


   
  

 }



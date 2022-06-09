<?php

namespace App\Repository;


use App\Models\Gender;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;



 class TeacherRepository implements TeacherRepository_Interface {


    public function index()
    {
        $teachers = Teacher::all();

        return view('pages.teachers.teachers',compact('teachers'));
    }


    public function create()
    {
        $specializations = Specialization::all();
        $genders = Gender::all();

        return view('pages.teachers.create', compact('specializations', 'genders'));
    }



    public function store($request)
    {
        $request->validate([
            'Email' => 'required|unique:teachers,Email,',
            'Password' => 'required',
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
            'Address' => 'required',
        ], [
            'Email.required' => trans('Teacher_trans.email_required'),
            'Email.unique' => trans('Teacher_trans.unique'),
            'Password.required' => trans('Teacher_trans.password_required'),
            'Name_ar.required' => trans('Teacher_trans.required_name'),
            'Name_en.required' => trans('Teacher_trans.required_name'),
            'Specialization_id.required' => trans('Teacher_trans.Specialization_required'),
            'Gender_id.required' => trans('Teacher_trans.gender_required'),
            'Joining_Date.required' => trans('Teacher_trans.Joining_Date_required'),
            'Address.required' => trans('Teacher_trans.Address_required'),
        ]);
        $teachers = new Teacher() ;

        $teachers->create([
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'Name' => ['ar' => $request->Name_ar, 'en' => $request->Name_en ],
            'Specialization_id' => $request->Specialization_id,
            'Gender_id' => $request->Gender_id,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('teachers.index');
    }

    public function edit($id)
    {
        $teachers = Teacher::findOrFail($id);
        $specializations = Specialization::all();
        $genders = Gender::all();

        return view('pages.teachers.edit', compact('teachers', 'specializations', 'genders'));
    }


    public function update($request,)
    {

        $request->validate([
            'Email' => 'required|unique:teachers,Email,',
            'Password' => 'required',
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
            'Address' => 'required',
        ], [
            'Email.required' => trans('Teacher_trans.email_required'),
            'Email.unique' => trans('Teacher_trans.unique'),
            'Password.required' => trans('Teacher_trans.password_required'),
            'Name_ar.required' => trans('Teacher_trans.required_name'),
            'Name_en.required' => trans('Teacher_trans.required_name'),
            'Specialization_id.required' => trans('Teacher_trans.Specialization_required'),
            'Gender_id.required' => trans('Teacher_trans.gender_required'),
            'Joining_Date.required' => trans('Teacher_trans.Joining_Date_required'),
            'Address.required' => trans('Teacher_trans.Address_required'),
        ]);

        $teachers = Teacher::findOrFail($request->id);
        
        $teachers->update([
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'Name' => ['ar' => $request->Name_ar, 'en' => $request->Name_en ],
            'Specialization_id' => $request->Specialization_id,
            'Gender_id' => $request->Gender_id,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect()->route('teachers.index');


    }

    public function destroy($request)
    {
        $teachers = Teacher::findOrFail($request->id)->delete();

        toastr()->error(trans('messages.delete'));
        return redirect()->route('teachers.index');

    }



 }



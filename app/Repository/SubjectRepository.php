<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;





 class SubjectRepository implements SubjectRepository_Interface {


    public function index()
    {
        $subjects = Subject::all();

        return view('pages.subjects.index',compact('subjects'));
    }


    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.subjects.create', compact('grades', 'teachers'));
    }



    public function store($request)
    {
        $request->validate([
            'Name_ar' => 'required|unique:subjects,name,id',
            'Name_en' => 'required|unique:subjects,name,id',
            'Grade_id' => 'required',
            'classroom_id' => 'required',
            'teacher_id' => 'required',
        ],[
            'Name_ar.required' =>trans('Subjects_trans.subject_name_required'),
            'Name_en.required' =>trans('Subjects_trans.subject_name_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'classroom_id.required' => trans('Accounts.class_name_required'),
            'teacher_id.required' => trans('Teacher_trans.required_name'),
        ]);
       
        $subjects = new Subject() ;

        $subjects->create([
            'name' => ['ar' => $request->Name_ar, 'en' => $request->Name_en],
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
            'teacher_id' => $request->teacher_id,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('subjects.index');
    }

    public function edit($id)
    {
        $subjects = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.subjects.edit', compact('teachers', 'grades', 'subjects'));
    }


    public function update($request,)
    {

        $request->validate([
            'Name_ar' => 'required|unique:subjects,name,id',
            'Name_en' => 'required|unique:subjects,name,id',
            'Grade_id' => 'required',
            'classroom_id' => 'required',
            'teacher_id' => 'required',
        ],[
            'Name_ar.required' =>trans('Subjects_trans.subject_name_required'),
            'Name_en.required' =>trans('Subjects_trans.subject_name_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'classroom_id.required' => trans('Accounts.class_name_required'),
            'teacher_id.required' => trans('Teacher_trans.required_name'),
        ]);

        $subjects = Subject::findOrFail($request->id);
        
        $subjects->update([
            'name' => ['ar' => $request->Name_ar, 'en' => $request->Name_en],
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
            'teacher_id' => $request->teacher_id,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect()->route('subjects.index');


    }

    public function destroy($request)
    {
         Subject::destroy($request->id);

        toastr()->error(trans('messages.delete'));
        return redirect()->route('subjects.index');

    }



 }



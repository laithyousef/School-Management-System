<?php

namespace App\Repository;


use App\Models\Quiz;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassRoom;



 class QuizRepository implements QuizRepository_Interface {


    public function index()
    {
        $quizzes = Quiz::all();

        return view('pages.quizzes.index',compact('quizzes'));
    }


    public function create()
    {
        $data['sections'] = Section::all();
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.quizzes.create', $data);
    }



    public function store($request)
    {
        $request->validate([
            'Name_en' => 'required|unique:quizzes,name->en,id',
            'Name_ar' => 'required|unique:quizzes,name->ar,id',
            'subject_id' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required',
        ],[
            'Name_en.required' => trans('quizzes_trans.quize_name_required'),
            'Name_en.unique' => trans('quizzes_trans.unique_quiz_name'),
            'Name_ar.required' => trans('quizzes_trans.quize_name_required'),
            'Name_ar.unique' => trans('quizzes_trans.unique_quiz_name'),
            'subject_id.required' =>trans('Subjects_trans.subject_name_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Class_id.required' => trans('Accounts.class_name_required'),
            'teacher_id.required' => trans('Teacher_trans.required_name'),
        ]);
    
        $quizzes = new Quiz();

        $quizzes->create([
            'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'subject_id' => $request->subject_id,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
            'section_id' => $request->section_id,
            'teacher_id' => $request->teacher_id,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('quizzes.index');
    }

    public function edit($id)
    {
        $quizz = Quiz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['class_rooms'] = ClassRoom::all();
        $data['sections'] = Section::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();

        return view('pages.quizzes.edit', $data, compact('quizz'));
    }


    public function update($request,)
    {
        $request->validate([
            'Name_en' => 'required|unique:quizzes,name,id',
            'Name_ar' => 'required|unique:quizzes,name,id',
            'subject_id' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required',
        ],[
            'Name_en.required' => trans('quizzes_trans.quize_name_required'),
            'Name_en.unique' => trans('Students_trans.unique'),
            'Name_ar.required' => trans('quizzes_trans.quize_name_required'),
            'Name_ar.unique' => trans('Students_trans.unique'),
            'subject_id.required' =>trans('Subjects_trans.subject_name_required'),
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Class_id.required' => trans('Accounts.class_name_required'),
            'teacher_id.required' => trans('Teacher_trans.required_name'),
        ]);

        $quizzes = Quiz::findOrFail($request->id);
        
        $quizzes->update([
            'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'subject_id' => $request->subject_id,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
            'section_id' => $request->section_id,
            'teacher_id' => $request->teacher_id,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect()->route('quizzes.index');


    }

    public function destroy($request)
    {
        Quiz::destroy($request->id);

        toastr()->error(trans('messages.delete'));
        return redirect()->route('quizzes.index');

    }



 }



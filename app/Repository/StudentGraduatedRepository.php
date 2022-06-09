<?php

namespace App\Repository;



use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



 class StudentGraduatedRepository implements StudentGraduatedRepository_Interface {

  
  public function index()
  {
      $students = Student::onlyTrashed()->get();
      return view('pages.students.graduated.index',compact('students'));
  }


  public function create()
  {

    $grades = Grade::all();
    $sections = Section::all();
    return view('pages.students.graduated.create',compact('grades', 'sections'));
    
  }


  public function graduating_Students($request)
  {

    $students = Student::where('Grade_id', $request->Grade_id )
    ->where('Classroom_id', $request->Classroom_id)
    ->where('section_id', $request->section_id)->get();

    foreach ($students as $student) {
      
      $ids = explode(',', $student->id);
      Student::whereIn('id', $ids)->Delete();
    }

    toastr()->success(trans('messages.success'));
    return redirect()->route('graduated.index');
  }


  public function return_student()
  {
    $students = Student::withTrashed()->restore();

    toastr()->success(trans('messages.success'));
    return redirect()->route('graduated.index');
  }
  

  public function destroy($request)
  {
    $students = Student::withTrashed()->where('id', $request->id)->forceDelete();

    toastr()->error(trans('messages.delete'));
    return redirect()->back();
  }

 }



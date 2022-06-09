<?php

namespace App\Repository;


use App\Models\Grade;
use App\Models\Gender;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;



 class StudentsAttendanceRepository implements StudentsAttendanceRepository_Interface {


    public function index()
    {
        $grades = Grade::with(['Sections'])->get();
        $teachers = Teacher::all();

        return view('pages.students.attendance.sections',compact('teachers', 'grades'));
    }


    public function show($id)
    {
        $students = Student::all();
        $genders = Gender::all();

        return view('pages.students.attendance.attendances', compact('students', 'genders'));
    }



    public function store($request)
    {
        $request->validate([
            'student_id' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'teacher_id' => 'required',
        ],[
            'student_id.required' => trans('Students_trans.required_Name'),
            'grade_id.required' => trans('Accounts.grade_required'),
            'classroom_id.required' => trans('Accounts.class_name_required'),
            'teacher_id.required' => trans('Teacher_trans.required_name'),

        ]);

      
        foreach ($request->attendances as $student_id => $attendance) {

            if( $attendance == 'present' ) {
                $attendence_status = true;
            } else if( $attendance == 'absent' ){
                $attendence_status = false;
            }
       
            $attendances = new Attendance() ;
            $attendances->create([
            'student_id' => $student_id,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => 1,
            'attendence_date' => date('Y-m-d'),
            'attendence_status' => $attendence_status,
        ]);
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route('attendance.index');
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
            'Email' => 'required',
            'Password' => 'required',
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
            'Address' => 'required',
        ], [
            'Email.required' => trans('validation.required'),
            'Email.unique' => trans('validation.unique'),
            'Password.required' => trans('validation.required'),
            'Name_ar.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.required'),
            'Specialization_id.required' => trans('validation.required'),
            'Gender_id.required' => trans('validation.required'),
            'Joining_Date.required' => trans('validation.required'),
            'Address.required' => trans('validation.required'),
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



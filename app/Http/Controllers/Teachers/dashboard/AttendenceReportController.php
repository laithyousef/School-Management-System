<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Section;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AttendenceReportController extends Controller
{
    public function index()
    {
        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.teachers.dashboard.students.index', compact('students'));
    }

    public function sections()
    {
        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $ids)->get();
        return view('pages.teachers.dashboard.sections.index', compact('sections'));
    }



    public function attendance(Request $request)
    {
        try {
            $attend_date = date('Y-m-d');

            foreach ($request->attendences as $studentId => $attendence) {
                if ($attendence == 'presence') {
                    $attendence_status = true;
                } elseif ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateOrCreate([ 'student_id' => $studentId ], [
                    'student_id' => $studentId,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' => $attend_date,
                    'attendence_status' => $attendence_status
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function attendance_report()
    {
        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        return view('pages.teachers.dashboard.attendance_report', compact('students'));
    }


    public function attendance_search(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        
        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
        return view('pages.teachers.dashboard.attendance_report', compact('students', 'Students'));

        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->where('student_id', $request->student_id)->get();
            return view('pages.teachers.dashboard.attendance_report', compact('students', 'Students'));
        }
    }

   
}

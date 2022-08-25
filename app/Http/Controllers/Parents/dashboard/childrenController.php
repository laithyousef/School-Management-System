<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Models\Degree;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\FeeInvoice;
use Illuminate\Http\Request;
use App\Models\StudentReceipt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class childrenController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id', Auth::user()->id)->get();

        return view('pages.parents.children.index', compact('students'));
    }

    public function sons_results($id)
    {
        $students = Student::findOrFail($id);

        if ($students->parent_id !== Auth::user()->id) {
        toastr()->error(trans('parent_trans.there_is_an_error_in_the_student_code'));
        return redirect()->route('parent.index');
        }

        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
        toastr()->error(trans('parent_trans.history_formula_must_be'));
        return redirect()->route('parent.index');
        }
     
        return view('pages.parents.degrees.index', compact('degrees'));
    }

    public function sons_attendance()
    {
        $students = Student::where('parent_id', Auth::user()->id)->get();
        return view('pages.parents.children.attendence', compact('students'));
        
    }

    public function attendance_search(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => "{{ trans('parent_trans.the_end_date_must_be_grater_than_the_date_of_beginning') }}",
            'from.date_format' => "{{ trans('parent_trans.history_formula_must_be') }}",
            'to.date_format' => "{{ trans('parent_trans.history_formula_must_be') }}",
        ]);

        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.parents.children.attendence', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parents.children.attendence ', compact('Students', 'students'));

        }

    }

    public function sons_fees()
    {
        $students = Student::where('parent_id', Auth::user()->id)->pluck('id');

        $fees_invoices = FeeInvoice::whereIN('student_id', $students);

        return view('pages.parents.children.fees', compact('fees_invoices'));
    }

    public function sons_receipt($id)
    {
        $student = Student::findOrFail($id);
        if ($students->parent_id !== Auth::user()->id) {
            toastr()->error(trans('parent_trans.there_is_an_error_in_the_student_code'));
            return redirect()->route('parent.index');
            }


        $students_receipt = StudentReceipt::where('student_id', $id);
         if ($students_receipt->isEmpty()) {
        toastr()->error(trans('parent_trans.history_formula_must_be'));
        return redirect()->route('parent.index');
        }
     
        return view('pages.parents.children.receipt', compact('students_receipt'));
    }

    public function parent_profile()
    {
        $information = Parents::findorFail(auth()->user()->id);
        return view('pages.parents.profile', compact('information'));
    }

    public function update_parent_profile($id)
    {
        $information = Parents::findorFail($id);

        if (!empty($request->password)) {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.update'));
        return redirect()->back();
    }
}

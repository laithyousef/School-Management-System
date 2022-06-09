<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;


 class StudentPromotionRepository implements StudentPromotionRepository_Interface {

    public function index()
    {
        $promotions = Promotion::all();
        return view('pages.students.promotion.management_promotion',compact('promotions'));
    }
  
    public function create()
    {
        $grades = Grade::all();
        $sections = Section::all();
        $students = Student::all();
        return view('pages.students.promotion.student_promotion',compact('students', 'grades', 'sections'));
    }
    


    public function store($request)
    {

        DB::beginTransaction();

        try {
            
            $students = Student::where('Grade_id', $request->Grade_id)
            ->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->where('academic_year', $request->academic_year)->get();

            foreach ($students as $student) {
                
               $ids = explode(',', $student->id);
    
               Student::whereIn('id', $ids)->update([
                   'Grade_id' => $request->Grade_id_new,
                   'Classroom_id' => $request->Classroom_id_new,
                   'section_id' => $request->section_id_new,
                   'academic_year'=>$request->academic_year_new,
               ]); 
    
               Promotion::updateOrCreate([
                   'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id ,
                    'to_grade' => $request->Grade_id_new,
                    'to_classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
               ]);
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('promotions.index');
           
        }

        catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
      
          
    }


    public function promotion_roll_back()
    {
        $promotions = Promotion::all();

        return view('pages.students.promotion.management_promotion', compact('promotions'));
    }


    public function destroy($request)
    {

        DB::beginTransaction();

        try {
            
       
        if($request->page_id == 1) {

            $promotions = Promotion::all();

            foreach ($promotions as $promotion) {
            
            

            $ids = explode(',', $promotion->student_id);

            Student::whereIn('id', $ids)->update([
                
                'Grade_id' => $promotion->from_grade,
                'Classroom_id' =>  $promotion->from_classroom,
                'section_id' => $promotion->from_section,
                'academic_year'=>$promotion->academic_year,
                
            ]);

            Promotion::truncate();
        }

        DB::commit();
        toastr()->error(trans('messages.delete'));
        return redirect()->back();
        
        } else {

            $promotions = Promotion::findOrFail($request->id);
            Student::where('id', $promotions->student_id)
            ->update([
                'Grade_id'=>$promotions->from_grade,
                'Classroom_id'=>$promotions->from_classroom,
                'section_id'=> $promotions->from_section,
                'academic_year'=>$promotions->academic_year,

            ]);

            Promotion::destroy($request->id);

        }

        DB::commit();
        toastr()->error(trans('messages.delete'));
        return back();

    } catch (\Throwable $th) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $th->getMessage()]);
    }
    }

   

 }



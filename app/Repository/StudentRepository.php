<?php

namespace App\Repository;


use App\Models\Grade;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Parents;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\Blood_Type;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



 class StudentRepository implements StudentRepository_Interface {

  
    public function index()
    {
        $students = Student::all();
        return view('pages.students.index',compact('students'));
    }


    public function create()
    {

        $data['grades'] = Grade::all();
        $data['parents'] = Parents::all();
        $data['genders'] = Gender::all();
        $data['sections'] = Section::all();
        $data['nationalities'] = Nationality::all();
        $data['blood_types'] = Blood_Type::all();
        return view('pages.students.add_students',$data);
 
    }


    public function store($request)
    {
        DB::beginTransaction();

        $request->validate([
            'name_en' => 'required|unique:students,name->en,id',
            'name_ar' => 'required|unique:students,name->ar,id',
            'email' => 'required|email',
            'password' => 'required',
            'gender_id' => 'required',
            'nationalitie_id' => 'required',
            'blood_id' => 'required',
            'Date_Birth' => 'required|date',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'parent_id' => 'required',
            'academic_year' => 'required',
        ],[

            'name_en.required' => trans('Students_trans.required_Name'),
            'name_ar.required' => trans('Students_trans.required_Name'),
            'email.required' => trans('Students_trans.email_required'),
            'password.required' => trans('Students_trans.required_password'),
            'gender_id.required' => trans('Students_trans.required_gender'),
            'nationalitie_id.required' => trans('Students_trans.required_nationality'),
            'blood_id.required' => trans('Students_trans.required_blood'),
            'Date_Birth.required' => trans('Students_trans.required_Date_Birth'),
            'Grade_id.required' => trans('Students_trans.required_Grade'),
            'Classroom_id.required' => trans('Students_trans.required_Classroom'),
            'parent_id.required' => trans('Students_trans.required_parent'),
            'academic_year.required' => trans('Students_trans.required_academic_year'),

        ]);

        try {

            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();


            foreach ($request->file('photos') as $file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('attachments/students/'. $students->name, $name, 'upload_attachments');
                
                $images = new Image();
                $images->create([
                    'filename' => $name,
                    'imageable_id' => $students->id,
                    'imageable_type' => 'App\Model\Student',
                ]);

            }
            DB::commit(); // insert data

            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);

        }
     
    }


    public function show($id)
    {
        $students = Student::findOrFail($id);

        return view('pages.students.show', compact('students'));
    }


    public function edit($id)
    {
        $students = Student::findOrFail($id);
        $data['grades'] = Grade::all();
        $data['parents'] = Parents::all();
        $data['Genders'] = Gender::all();
        $data['sections'] = Section::all();
        $data['class_rooms'] = ClassRoom::all();
        $data['nationalities'] = Nationality::all();
        $data['blood_types'] = Blood_Type::all();
        return view('pages.students.edit',$data, compact('students'));

    }


    public function update($request)
    {

        $request->validate([
            'name_en' => 'required|unique:students,name->en,id',
            'name_ar' => 'required|unique:students,name->ar,id',
            'email' => 'required|email',
            'password' => 'required',
            'gender_id' => 'required',
            'nationalitie_id' => 'required',
            'blood_id' => 'required',
            'Date_Birth' => 'required|date',
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'parent_id' => 'required',
            'academic_year' => 'required',
        ],[

            'name_en.required' => trans('Students_trans.required_Name'),
            'name_ar.required' => trans('Students_trans.required_Name'),
            'email.required' => trans('Students_trans.email_required'),
            'password.required' => trans('Students_trans.required_password'),
            'gender_id.required' => trans('Students_trans.required_gender'),
            'nationalitie_id.required' => trans('Students_trans.required_nationality'),
            'blood_id.required' => trans('Students_trans.required_blood'),
            'Date_Birth.required' => trans('Students_trans.required_Date_Birth'),
            'Grade_id.required' => trans('Students_trans.required_Grade'),
            'Classroom_id.required' => trans('Students_trans.required_Classroom'),
            'parent_id.required' => trans('Students_trans.required_parent'),
            'academic_year.required' => trans('Students_trans.required_academic_year'),

        ]);

        
        $students = Student::findOrFail($request->id);

        $students->update([

            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender_id' => $request->gender_id,
            'nationalitie_id' => $request->nationalitie_id,
            'blood_id' => $request->blood_id,
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'parent_id' => $request->parent_id,
            'Date_Birth' => $request->Date_Birth,
            'academic_year' => $request->academic_year,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect()->route('students.index');
    }


    public function upload_attachment($request)
    {

        foreach ($request->file('photos') as $file) {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'. $request->student_name, $name, 'upload_attachments');
            
            $images = new Image();
            $images->create([
                'filename' => $name,
                'imageable_id' => $request->student_id,
                'imageable_type' => 'App\Model\Student',
            ]);

        }
        toastr()->success(trans('messages.attachment_success'));
        return redirect()->back();

    }


    public function download_attachment( $students_name, $filename)
    {
        return response()->download(public_path('attachments/students/' . $students_name. '/' .$filename ));
    }


    public function delete_attachment($request)
    {
       
        Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/'. $request->filename);

        Image::where('id', $request->id)->delete();


        toastr()->error(trans('messages.delete'));
        return redirect()->route('students.index');
    }


    public function destroy($request)
    {
        Student::destroy($request->id);
        toastr()->error(trans('messages.delete'));
        return redirect()->route('students.index');
    }


    public function get_classes($id)
    {
        $class_rooms = ClassRoom::where('grade_id', $id)->pluck('name','id');

        return json_encode($class_rooms);
    }


    public function get_sections($id)
    {
        $sections = Section::where('class_id', $id)->pluck('name','id');

        return json_encode($sections);
    }
  

 }



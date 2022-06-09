<?php

namespace App\Http\Controllers\Sections;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with(['Sections'])->get();
        $list_grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.sections.sections', compact('grades', 'list_grades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'Name_Section_Ar' => 'required|unique:sections,name->ar',
            'Name_Section_En' => 'required|unique:sections,name->en',
            'Grade_id' => 'required',
            'Class_id' => 'required',
        ], [
            'Name_Section_Ar.required' => trans('Sections_trans.required_ar'),
            'Name_Section_En.required' => trans('Sections_trans.required_en'),
            'Name_Section_Ar.unique' => trans('Sections_trans.unique_name_ar'),
            'Name_Section_En.unique' => trans('Sections_trans.unique_name_er'),
            'Grade_id.required' => trans('Sections_trans.Grade_id_required'),
            'Class_id.required' => trans('Sections_trans.Class_id_required'),
        ]);

        $sections = new Section();

        $sections->name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $sections->grade_id = $request->Grade_id;
        $sections->class_id = $request->Class_id;
        $sections->save();
        $sections->teachers()->attach($request->teacher_id);


        // $sections->create([
        //     'name' => ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
        //     'grade_id' => $request->Grade_id,
        //     'class_id' => $request->Class_id,
        // ]);

        // $sections->teachers()->attach($teacher_id);

        toastr()->success(trans('messages.success'));
        return redirect('sections');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            
            'Name_Section_Ar' => 'required',
            'Name_Section_En' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
        ], [
            'Name_Section_Ar.required' => trans('Sections_trans.required_ar'),
            'Name_Section_En.required' => trans('Sections_trans.required_en'),
            'Name_Section_Ar.unique' => trans('Sections_trans.unique_name_ar'),
            'Name_Section_En.unique' => trans('Sections_trans.unique_name_ar'),
            'Grade_id.required' => trans('Sections_trans.Grade_id_required'),
            'Class_id.required' => trans('Sections_trans.Class_id_required'),
        ]);
        $id = $request->id;
        $sections = Section::find($id);

        if(isset($request->Status)) {

            $sections->status = 1;
        } else{
            $sections->status = 2;
        }

        $sections->update([

            'name' => ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En],
            'grade_id' => $request->Grade_id,
            'class_id' => $request->Class_id,
        ]);

        if(isset($request->teacher_id)) {
            $sections->teachers()->sync($request->teacher_id);
        } else {
            $sections->teachers()->sync(array());
        }

       


        toastr()->info(trans('messages.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sections = Section::find($request->id)->delete();

        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function get_classes($id)
    {
        $class_rooms = ClassRoom::where('grade_id', $id)->pluck('name','id');

        return json_encode($class_rooms);
    }
}

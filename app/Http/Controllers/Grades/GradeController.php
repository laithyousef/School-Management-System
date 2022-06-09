<?php

namespace App\Http\Controllers\Grades;


use App\Models\Grade;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.index', compact('grades'));
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

        // if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {

        //     return redirect()->back()->withErrors(trans('grades_trans.exists'));
        // }
        
        $request->validate([
            'Name' => 'required|unique:grades,Name->ar,id',
            'Name_en' => 'required|unique:grades,Name->en,id',
            'Notes' => 'max:100',
        ],[
            'Name.required' => trans('grades_trans.required'),
            'Name_en.required' => trans('grades_trans.required'),
            'Name.unique' => trans('grades_trans.exists'),
            'Name_en.unique' => trans('grades_trans.exists'),

        ]);

        try {
          

            $grades = new Grade;
            $grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grades->Notes = $request->Notes;
            $grades->save();

            toastr()->success(trans('messages.success'));
            return redirect('grades');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->id;

        try {
            $request->validate([
                'Name' => 'required|unique:grades',
                'Notes' => 'max:100',
            ],[
                'Name.required' => trans('validation.required')
            ]);

            $grades = Grade::find($id);
            $grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grades->Notes = $request->Notes;
            $grades->save();

            toastr()->info(trans('messages.update'));
            return redirect('grades');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $class_rooms = ClassRoom::where('grade_id', $request->id)->pluck('Grade_id');

        if($class_rooms->count() == 0) {

            $id = $request->id;
            $grades = Grade::find($id);
            $grades->delete();

            toastr()->error(trans('messages.delete'));
            return back();

        } else {

            toastr()->error(trans('messages.delete_warning'));
            return redirect('grades');
    
        }
      
    }
}

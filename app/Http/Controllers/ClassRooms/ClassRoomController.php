<?php

namespace App\Http\Controllers\ClassRooms;

use App\Models\Grade;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_rooms = ClassRoom::all();
        $grades = Grade::all();
        return view('pages.class_rooms.class_rooms', compact('class_rooms', 'grades'));
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
            
            'List_Classes.*.Name' => 'required|unique:class_rooms,name->ar,id',
            'List_Classes.*.Name_class_en' => 'required|unique:class_rooms,name->en,id',
        ],[
            'List_Classes.*.Name.required' => trans('grades_trans.class_required'),
            'List_Classes.*.Name_class_en.required' => trans('grades_trans.class_required'),
            'List_Classes.*.Name.unique' => trans('grades_trans.class_exists'),
            'List_Classes.*.Name_class_en.unique' => trans('grades_trans.class_exists'),
        ]);

        $List_Classes = $request->List_Classes;
        
        foreach ($List_Classes as $List_Class) {
            $class_rooms = new ClassRoom();

            $class_rooms->name = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
            $class_rooms->grade_id = $List_Class['Grade_id'];

            $class_rooms->save();
        }
        
     

        toastr()->success(trans('messages.success'));
        return redirect('class_rooms');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            
            'List_Classes.*.Name' => 'required|unique:class_rooms,name->ar,id',
            'List_Classes.*.Name_class_en' => 'required|unique:class_rooms,name->en,id',
        ],[
            'List_Classes.*.Name.required' => trans('grades_trans.class_required'),
            'List_Classes.*.Name_class_en.required' => trans('grades_trans.class_required'),
            'List_Classes.*.Name.unique' => trans('grades_trans.class_exists'),
            'List_Classes.*.Name_class_en.unique' => trans('grades_trans.class_exists'),
        ]);

        $id = $request->id;
        $class_rooms = ClassRoom::find($id);

        $class_rooms->update([
            'name' => ['ar' => $request->Name, 'en' => $request->Name_en ],
            'grade_id' => $request->Grade_id,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect('class_rooms');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $class_rooms = ClassRoom::find($id)->delete();

        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",",  $request->delete_all_id);
        $class_rooms = ClassRoom::whereIn('id', $delete_all_id )->delete();
        

        toastr()->error(trans('messages.delete'));
        return back();

    }

    public function filter_classes(Request $request)
    {
            $grades = Grade::all();
            $search = ClassRoom::select('*')->where('grade_id',$request->Grade_id)->get();

            return view('pages.class_rooms.class_rooms', compact('grades'))->withDetails($search);
        }
    
}

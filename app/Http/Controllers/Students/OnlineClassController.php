<?php

namespace App\Http\Controllers\Students;

use App\Models\Grade;
use App\Models\Section;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;

class OnlineClassController extends Controller
{
    use MeetingZoomTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $online_classes = OnlineClass::all();
        return view('pages.students.online_classes.index', compact('online_classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        $sections = Section::all();
        return view('pages.students.online_classes.add', compact('grades', 'sections'));
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
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
            'topic' => 'required',
            'start_time' => 'required',
            'duration' => 'required',
        ],[
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Classroom_id.required' => trans('Accounts.class_name_required'),
            'section_id.required' => trans('online_classes_trans.section_required'),
            'topic.required' => trans('online_classes_trans.topic_required'),
            'start_time.required' => trans('online_classes_trans.start_time_required'),
            'duration.required' => trans('online_classes_trans.duration_required'),
        ]);
    
        try {

        $meetings = $this->createMeeting($request);

        OnlineClass::create([
            
            'integration' => true,
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'created_by' => auth()->user()->email,
            'meeting_id' => $meetings->password,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $meetings->password,
            'start_url' => $meetings->start_url,
            'join_url' => $meetings->join_url,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('online_classes.index');

    } catch (\Exception $th) {
        return redirect()->back()->with(['error' => $th->getMessage()]);
    }


    }


    public function create_indirect()
    {
        $grades = Grade::all();
        $sections = Section::all();
        return view('pages.students.online_classes.indirect', compact('grades', 'sections'));
    }


    public function store_indirect(Request $request)
    {
        $request->validate([
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
            'section_id' => 'required',
            'topic' => 'required',
            'start_time' => 'required',
            'duration' => 'required',
        ],[
            'Grade_id.required' => trans('Accounts.grade_required'),
            'Classroom_id.required' => trans('Accounts.class_name_required'),
            'section_id.required' => trans('online_classes_trans.section_required'),
            'topic.required' => trans('online_classes_trans.topic_required'),
            'start_time.required' => trans('online_classes_trans.start_time_required'),
            'duration.required' => trans('online_classes_trans.duration_required'),
        ]);
        
        try {
            OnlineClass::create([

                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Grade;
use App\Models\Section;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;

class OnlineZoomClassController extends Controller
{

    use MeetingZoomTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $online_classes = OnlineClass::where('created_by',auth()->user()->email)->get();
        return view('pages.teachers.dashboard.online_classes.index', compact('online_classes'));

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
        return view('pages.teachers.dashboard.online_classes.add', compact('grades', 'sections'));

        $Grades = Grade::all();
        return view('pages.Teachers.dashboard.online_classes.add', compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          // try {

            $meetings = $this->createMeeting($request);

            OnlineClass::create([
                
                // 'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meetings->id,
                'topic' => $request->topic,
                'start_at' => $request->start_at,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $meetings->start_url,
                'join_url' => $meetings->join_url,
            ]);
    
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
    
        // } catch (\Exception $th) {
        //     return redirect()->back()->with(['error' => $th->getMessage()]);
        // }
    }

    public function create_indirect()
    {
        $grades = Grade::all();
        $sections = Section::all();

        return view('pages.teachers.dashboard.online_classes.indirect', compact('grades', 'sections'));
    }

    public function store_indirect(Request $request)
    {
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
            return redirect()->route('online_zoom_classes.index');

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

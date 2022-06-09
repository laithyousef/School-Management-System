<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Quiz;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Question;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::where('teacher_id',auth()->user()->id)->get();

        return view('pages.teachers.dashboard.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['sections'] = Section::all();
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        $data['teachers'] = Teacher::all();

        return view('pages.teachers.dashboard.quizzes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $quizzes = new Quiz();

        $quizzes->create([
            'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'subject_id' => $request->subject_id,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
            'section_id' => $request->section_id,
            'teacher_id' =>  auth()->user()->id,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('quizzes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quiz::findorFail($id);
        return view('pages.Teachers.dashboard.Questions.index',compact('questions','quizz'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quizz = Quiz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['class_rooms'] = ClassRoom::all();
        $data['sections'] = Section::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();

        return view('pages.teachers.dashboard.quizzes.edit', $data, compact('quizz'));
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

        $quizzes = Quiz::findOrFail($request->id);
        
        $quizzes->update([
            'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            'subject_id' => $request->subject_id,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Class_id,
            'section_id' => $request->section_id,
            'teacher_id' =>  auth()->user()->id,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect()->route('quizzes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quiz::destroy($request->id);

        toastr()->error(trans('messages.delete'));
        return redirect()->route('quizzes.index');
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

<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $questions = new Question() ;

        $questions->create([
            'title' => $request->title,
            'answers' => $request->answers,
            'right_answer' => $request->right_answer,
            'score' => $request->score,
            'quizze_id' => $request->quizze_id,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quizz_id = $id;
        $quizzes = Quiz::all();
        return view('pages.teachers.dashboard.questions.create', compact('quizz_id', 'quizzes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questions = Question::findOrFail($id);
        $quizzes = Quiz::all();

        return view('pages.teachers.dashboard.questions.edit', compact('questions', 'quizzes'));
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
        $questions = Question::findOrFail($request->id);
        
        $questions->update([
            'title' => $request->title,
            'answers' => $request->answers,
            'right_answer' => $request->right_answer,
            'score' => $request->score,
            'quizze_id' => $request->quizze_id,
        ]);

        toastr()->info(trans('messages.update'));
        return redirect()->route('question.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::destroy($request->id);

        toastr()->error(trans('messages.delete'));
        return redirect()->route('question.index');
    }
}

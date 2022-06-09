<?php

namespace App\Repository;


use App\Models\Quiz;
use App\Models\Teacher;
use App\Models\Question;
use Illuminate\Http\Request;



 class QuestionRepository implements QuestionRepository_Interface {


    public function index()
    {
        $questions = Question::all();

        return view('pages.questions.index',compact('questions'));
    }


    public function create()
    {
        $quizzes = Quiz::all();

        return view('pages.questions.create', compact('quizzes'));
    }



    public function store($request)
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

    public function edit($id)
    {
        $questions = Question::findOrFail($id);
        $quizzes = Quiz::all();

        return view('pages.questions.edit', compact('questions', 'quizzes'));
    }


    public function update($request,)
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
        return redirect()->route('questions.index');


    }

    public function destroy($request)
    {
         Question::destroy($request->id);

        toastr()->error(trans('messages.delete'));
        return redirect()->route('questions.index');

    }



 }



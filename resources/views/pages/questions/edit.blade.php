@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('question_trans.Edit_Question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('question_trans.Edit_Question')}} :
    <span class="text-danger">{{$questions->title}}</span>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('questions.update','test') }}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{ trans('question_trans.Question') }}</label>
                                        <input type="text" name="title" id="input-name"
                                               class="form-control form-control-alternative" value="{{$questions->title}}">
                                        <input type="hidden" name="id" value="{{$questions->id}}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('question_trans.Answer') }}</label>
                                        <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4">{{$questions->answers}}</textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('question_trans.Right_Answer') }} </label>
                                        <input type="text" name="right_answer" id="input-name" class="form-control form-control-alternative" value="{{$questions->right_answer}}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{ trans('quizzes_trans.Quiz_Name') }} : <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="quizze_id">
                                                <option selected disabled>{{ trans('question_trans.Choose_Quiz_Name') }}  ...</option>
                                                @foreach($quizzes as $quizze)
                                                    <option value="{{ $quizze->id }}" {{$quizze->id == $questions->quizze_id ? 'selected':'' }} >{{ $quizze->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{ trans('question_trans.degree') }} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option selected disabled> {{ trans('question_trans.Choose_Degree') }}...</option>
                                                <option value="5" {{$questions->score == 5 ? 'selected':''}}>5</option>
                                                <option value="10" {{$questions->score == 10 ? 'selected':''}}>10</option>
                                                <option value="15" {{$questions->score == 15 ? 'selected':''}}>15</option>
                                                <option value="20" {{$questions->score == 20 ? 'selected':''}}>20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success  nextBtn btn-lg pull-right" type="submit">{{ trans('Students_trans.submit') }} </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

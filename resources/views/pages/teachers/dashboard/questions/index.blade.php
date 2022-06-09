@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('quizzes_trans.Question_List') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('quizzes_trans.Question_List') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('question.create')}}" class="btn btn-success " role="button"
                                   aria-pressed="true">{{ trans('question_trans.Add_New_Question') }}</a><br><br>
                                   <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ trans('question_trans.Question') }}</th>
                                            <th scope="col">{{ trans('question_trans.Answer') }}</th>
                                            <th scope="col">{{ trans('question_trans.Right_Answer') }} </th>
                                            <th scope="col">{{ trans('question_trans.degree') }}</th>
                                            <th scope="col">{{ trans('quizzes_trans.Quiz_Name') }} </th>
                                            <th scope="col">{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quizze->name}}</td>
                                                <td>
                                                    <a href="{{route('questions.edit',$question->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $question->id }}" title="حذف"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_exam{{$question->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                               <div class="modal-dialog" role="document">
                                                   <form action="{{route('questions.destroy','test')}}" method="post">
                                                       {{method_field('delete')}}
                                                       {{csrf_field()}}
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h5 style="font-family: 'Cairo', sans-serif;"
                                                                   class="modal-title" id="exampleModalLabel">{{ trans('question_trans.Delete_Question') }} </h5>
                                                               <button type="button" class="close" data-dismiss="modal"
                                                                       aria-label="Close">
                                                                   <span aria-hidden="true">&times;</span>
                                                               </button>
                                                           </div>
                                                           <div class="modal-body">
                                                               <p> {{ trans('My_Classes_trans.Warning_Grade') }} {{$question->name}}</p>
                                                               <input type="hidden" name="id" value="{{$question->id}}">
                                                           </div>
                                                           <div class="modal-footer">
                                                               <div class="modal-footer">
                                                                   <button type="button" class="btn btn-secondary"
                                                                           data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                   <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </form>
                                               </div>
                                           </div>
                                           
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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

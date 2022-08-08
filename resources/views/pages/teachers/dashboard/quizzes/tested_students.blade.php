@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{ trans('quizzes_trans.tested_students_list') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('quizzes_trans.tested_students_list') }}
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Students_trans.name') }}</th>
                                            <th>{{ trans('quizzes_trans.last_question') }}</th>
                                            <th>{{ trans('quizzes_trans.degree') }}</th>
                                            <th>{{ trans('quizzes_trans.tampering') }}</th>
                                            <th>{{ trans('quizzes_trans.the_date_of_the_last_exam') }}</th>
                                            <th>{{ trans('my_classes.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($degrees as $degree)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$degree->student->name}}</td>
                                                <td>{{$degree->question_id}}</td>
                                                <td>{{$degree->score}}</td>
                                                @if($degree->abuse == 0)
                                                    <td style="color: green">{{ trans('quizzes_trans.not_cheated') }}</td>
                                                @else
                                                    <td style="color: red">{{trans('quizzes_trans.was_cheated')}}</td>
                                                @endif
                                                <td>{{$degree->date}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#repeat_quizze{{ $degree->quizze_id }}" title="إعادة">
                                                        <i class="fas fa-repeat"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="repeat_quizze{{$degree->quizze_id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('exam_repetition', $degree->quizze_id)}}" method="post">
                                                        {{method_field('post')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">{{ trans('quizzes_trans.open_re_examination_for_the_student') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>{{$degree->student->name}}</h6>
                                                                <input type="hidden" name="student_id" value="{{$degree->student_id}}">
                                                                <input type="hidden" name="quizze_id" value="{{$degree->quizze_id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('my_classes.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-info">{{ trans('My_Classes.submit') }}</button>
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
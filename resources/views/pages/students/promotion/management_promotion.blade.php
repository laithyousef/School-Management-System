@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_translate.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_translate.list_students')}}
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

                                <button type="button" class="btn btn-danger btn-lg " data-toggle="modal" data-target="#Delete_all">
                                  {{trans('Students_trans.roll_back_all')}}
                                </button>

                                <a href="{{route('promotions.create')}}" class="btn btn-success btn-lg ml-3" role="button"
                                aria-pressed="true">{{trans('main_translate.add_Promotion')}}</a>

                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info"> {{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger"> {{ trans('Students_trans.old_grade') }}</th> 
                                            <th class="alert-danger"> {{ trans('Students_trans.academic_year') }}</th>
                                            <th class="alert-danger"> {{ trans('Students_trans.previous_class') }}</th>
                                            <th class="alert-danger"> {{ trans('Students_trans.previous_section') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_grade') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_academic_year') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_class') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_section') }}</th>
                                            <th class="alert-primary">{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr> 
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_grade->Name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->f_classroom->name}}</td>
                                                <td>{{$promotion->f_section->name}}</td>
                                                <td>{{$promotion->t_grade->Name}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>
                                                <td>{{$promotion->t_classroom->name}}</td>
                                                <td>{{$promotion->t_section->name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{ trans('Students_trans.student_roll_back') }}</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#"> {{ trans('Students_trans.student_graduate') }}</button>
                                                </td> 
                                            </tr>

                                         <!-- Deleted inFormation Student -->
                                        <div class="modal fade" id="Delete_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Students_trans.roll_back_all') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('promotions.destroy','test')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <input type="hidden" name="page_id" value="1">
                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('Students_trans.delete_all') }}</h5>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <!-- Deleted inFormation Student -->
                                        <div class="modal fade" id="Delete_one{{$promotion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Students_trans.student_roll_back') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('promotions.destroy','test')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{$promotion->id}}">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"> {{ trans('Students_trans.delete_all') }} {{$promotion->student->name}}</h5>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
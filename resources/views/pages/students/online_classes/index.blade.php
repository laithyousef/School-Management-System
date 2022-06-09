@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('online_classes_trans.Online_Classes')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('online_classes_trans.Online_Classes')}}
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
                                <a href="{{route('online_classes.create')}}" class="btn btn-success mr-4" role="button" aria-pressed="true">{{ trans('online_classes_trans.Add_New_Lesson') }}</a>
                                <a class="btn btn-warning" href="{{route('create_indirect')}}" >{{ trans('online_classes_trans.Add_New_Lesson') }}</a>
                                 <br><br><br><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('library_trans.Grade_Name') }}</th>
                                            <th>{{ trans('my_classes.Name_class') }}</th>
                                            <th>{{ trans('Sections_trans.Name_Section') }}</th>
                                            <th>{{ trans('Subjects_trans.Teacher_Name') }}</th>
                                            <th> {{ trans('online_classes_trans.Class_Title') }}</th>
                                            <th> {{ trans('online_classes_trans.Start_Date') }}</th>
                                            <th>{{ trans('online_classes_trans.Class_Time') }} </th>
                                            <th> {{ trans('online_classes_trans.Share_Link') }}</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_classe)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$online_classe->grade->Name}}</td>
                                            <td>{{ $online_classe->classroom->name }}</td>
                                            <td>{{$online_classe->section->name}}</td>
                                                <td>{{$online_classe->created_by}}</td>
                                                <td>{{$online_classe->topic}}</td>
                                                <td>{{$online_classe->start_at}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank"> {{ trans('online_classes_trans.Join_Now') }}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        {{-- @include('pages.online_classes.delete') --}}
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

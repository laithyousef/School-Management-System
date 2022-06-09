@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('library_trans.Books_List') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('library_trans.Books_List') }}
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
                                <a href="{{route('libraries.create')}}" class="btn btn-success " role="button"
                                   aria-pressed="true">{{ trans('library_trans.Add_New_Book') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('library_trans.Book_Name') }}</th>
                                            <th>{{ trans('Subjects_trans.Teacher_Name') }}</th>
                                            <th>{{ trans('library_trans.Grade_Name') }}</th>
                                            <th>{{ trans('Accounts.Class_Name') }}</th>
                                            <th>{{ trans('Sections_trans.Name_Section') }}</th>
                                            <th>{{ trans('grades_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$book->title}}</td>
                                                <td>{{$book->teacher->Name}}</td>
                                                <td>{{$book->grade->Name}}</td>
                                                <td>{{$book->classroom->name}}</td>
                                                <td>{{$book->section->name}}</td>
                                                <td>
                                                    <a href="{{route('download_attachment',$book->file_name)}}"  title=" {{ trans('library_trans.download_Book') }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-download"></i></a>
                                                    <a href="{{route('libraries.edit',$book->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_book{{ $book->id }}" title="{{ trans('Students_trans.delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.libraries.destroy')
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

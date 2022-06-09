@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Student_details')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Student_details')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{trans('Students_trans.Student_details')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab"
                                    aria-controls="profile-02"
                                    aria-selected="false">{{trans('Students_trans.Attachments')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{trans('Students_trans.name')}}</th>
                                            <td>{{ $students->name }}</td>
                                            <th scope="row">{{trans('Students_trans.email')}}</th>
                                            <td>{{$students->email}}</td>
                                            <th scope="row">{{trans('Students_trans.gender')}}</th>
                                            <td>{{$students->gender->Name}}</td>
                                            <th scope="row">{{trans('Students_trans.Nationality')}}</th>
                                            <td>{{$students->Nationality->name}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Students_trans.Grade')}}</th>
                                            <td>{{ $students->grade->Name }}</td>
                                            <th scope="row">{{trans('Students_trans.classrooms')}}</th>
                                            <td>{{$students->classroom->name}}</td>
                                            <th scope="row">{{trans('Students_trans.section')}}</th>
                                            <td>{{$students->section->name}}</td>
                                            <th scope="row">{{trans('Students_trans.Date_of_Birth')}}</th>
                                            <td>{{ $students->Date_Birth}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Students_trans.parent')}}</th>
                                            <td>{{ $students->parent->Father_Name}}</td>
                                            <th scope="row">{{trans('Students_trans.academic_year')}}</th>
                                            <td>{{ $students->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{route('upload_attachment')}}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="academic_year">{{trans('Students_trans.Attachments')}}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="photos[]" multiple
                                                        required>
                                                    <input type="hidden" name="student_name"
                                                        value="{{$students->name}}">
                                                    <input type="hidden" name="student_id" value="{{$students->id}}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{trans('Students_trans.submit')}}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('Students_trans.filename')}}</th>
                                                <th scope="col">{{trans('Students_trans.created_at')}}</th>
                                                <th scope="col">{{trans('Students_trans.Processes')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students->images as $attachment)
                                            <tr style='text-align:center;vertical-align:middle'>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$attachment->filename}}</td>
                                                <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                <td colspan="2">
                                                    <a class="btn btn-outline-info btn-sm"
                                                        href="{{url('download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->filename}}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp;
                                                        {{trans('Students_trans.Download')}}</a>

                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Delete_img{{ $attachment->id }}"
                                                        title="{{ trans('Grades_trans.Delete') }}">{{trans('Students_trans.delete')}}
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_img{{$attachment->id}}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                {{trans('Students_trans.Delete_attachment')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('delete_attachment')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{$attachment->id}}">

                                                                <input type="hidden" name="student_name"
                                                                    value="{{$attachment->imageable->name}}">
                                                                <input type="hidden" name="student_id"
                                                                    value="{{$attachment->imageable->id}}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">
                                                                    {{trans('Students_trans.Delete_attachment_tilte')}}
                                                                </h5>
                                                                <input type="text" name="filename" readonly
                                                                    value="{{$attachment->filename}}"
                                                                    class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                                                    <button
                                                                        class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
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
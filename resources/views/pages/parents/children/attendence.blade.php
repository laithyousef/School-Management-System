@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('parent_trans.attendance_report') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('parent_trans.attendance_report') }}
@stop
<!-- breadcrumb -->

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post"  action="{{ route('attendance_search') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('parent_trans.search_information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student">{{ trans('Students_trans.students') }}</label>
                                <select class="custom-select mr-sm-2" name="student_id">
                                    <option value="0">{{ trans('parent_trans.evreyone') }}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body datepicker-form">
                            <div class="input-group" data-date-format="yyyy-mm-dd">
                                <input type="text"  class="form-control range-from date-picker-default" placeholder="{{ trans('parent_trans.start_date') }}" required name="from">
                                <span class="input-group-addon">{{ trans('parent_trans.to_date') }}</span>
                                <input class="form-control range-to date-picker-default" placeholder="{{ trans('parent_trans.end_date') }}" type="text" required name="to">
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button><br><br>
                </form>
                <br>
                @isset($Students)
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">{{trans('Students_trans.name')}}</th>
                            <th class="alert-success">{{trans('Students_trans.Grade')}}</th>
                            <th class="alert-success">{{trans('Students_trans.section')}}</th>
                            <th class="alert-success">{{ trans('admin_dashboard_trans.Date_Of_Hiring') }}</th>
                            <th class="alert-warning">{{ trans('Accounts.Statement') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$student->students->name}}</td>
                                <td>{{$student->grade->Name}}</td>
                                <td>{{$student->section->name}}</td>
                                <td>{{$student->attendence_date}}</td>
                                <td>

                                    @if($student->attendence_status == 0)
                                        <span class="btn-danger">{{ trans('Attendence_trans.absence') }}</span>
                                    @else
                                        <span class="btn-success">{{ trans('Attendence_trans.Presence') }}</span>
                                    @endif
                                </td>
                            </tr>
                        {{-- @include('pages.Students.Delete') --}}
                        @endforeach
                    </table>
                </div>
                @endisset

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
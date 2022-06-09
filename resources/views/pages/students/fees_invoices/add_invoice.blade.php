@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{ trans('Accounts.Adding_New_Fees') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{ trans('Accounts.Adding_New_Fees') }} 
{{$students->name}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                        <form class=" row mb-30" action="{{ route('fees_invoices.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Fees">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name" class="mr-sm-2">{{ trans('Students_trans.name') }}</label>
                                                    <select class="fancyselect" name="student_id" required>
                                                            <option value="{{ $students->id }}">{{ $students->name }}</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('Accounts.Kind_Of_Fees') }}</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="fee_id" required>
                                                            <option value="">-- {{ trans('parent_trans.Choose') }} --</option>
                                                            @foreach($fees as $fee)
                                                                <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('Accounts.The_Amount') }}</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="amount" required>
                                                            <option value="">--  {{ trans('parent_trans.Choose') }} --</option>
                                                            @foreach($fees as $fee)
                                                                <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="description" class="mr-sm-2">{{ trans('Accounts.Statement') }}</label>
                                                    <div class="box">
                                                        <input type="text" class="form-control" name="description" required>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('my_classes.Processes') }}:</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('my_classes.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('my_classes.add_row') }}"/>
                                        </div>
                                    </div><br>
                                    <input type="hidden" name="Grade_id" value="{{$students->Grade_id}}">
                                    <input type="hidden" name="Classroom_id" value="{{$students->Classroom_id}}">

                                    <button type="submit" class="btn btn-success  nextBtn btn-lg pull-right">{{ trans('Students_trans.submit') }} </button>
                                </div>
                            </div>
                        </form>

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

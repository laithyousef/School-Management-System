@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{ trans('Accounts.Fee_Execlusion_Bonds') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('Accounts.Fee_Execlusion_Bonds') }}
{{$student->name}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form method="post"  action="{{ route('Fee_Processing.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Accounts.The_Amount') }} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="Debt" type="number" >
                                    <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> {{ trans('Accounts.Student_Account') }} : </label>
                                    <input  class="form-control" name="final_balance" value="{{ number_format($student->student_account->sum('debt') - $student->student_account->sum('credit'), 2) }}" type="text" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('Accounts.Statement') }} : <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
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

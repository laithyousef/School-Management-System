@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('Students_trans.Catch_Reciept')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{ trans('Accounts.Reciept') }}
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
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('grades_trans.Name') }}</th>
                                            <th>{{ trans('Accounts.The_Amount') }}</th>
                                            <th>{{ trans('Accounts.Statement') }}</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students_receipt as $student_receipt)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$student_receipt->student->name}}</td>
                                            <td>{{ number_format($student_receipt->debt, 2) }}</td>
                                            <td>{{$student_receipt->description}}</td>
                                                <td>
                                                    <a href="{{route('students_receipt.edit',$student_receipt->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$student_receipt->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <!-- Deleted inFormation Student -->
                                        <div class="modal fade" id="Delete_receipt{{$student_receipt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Accounts.Delete_Catch_Reciept') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('students_receipt.destroy','test')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{$student_receipt->id}}">
                                                            <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('messages.delete_warning') }}</h5>
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

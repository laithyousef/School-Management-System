@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
   {{trans('Accounts.Edit_Study_Fees')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{trans('Accounts.Edit_Study_Fees')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form action="{{route('fees.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Teacher_trans.Name_ar') }}</label>
                                <input type="text" value="{{$fee->getTranslation('title','ar')}}" name="title_ar" class="form-control">
                                <input type="hidden" value="{{$fee->id}}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Teacher_trans.Name_en') }}</label>
                                <input type="text" value="{{$fee->getTranslation('title','en')}}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Accounts.The_Amount') }}</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{ trans('Accounts.School_Stage') }} </label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    @foreach($grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $fee->Grade_id ? 'selected' : ""}}>{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Accounts.Class_Name') }} </label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{$fee->Classroom_id}}">{{$fee->classroom->name}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Students_trans.academic_year') }} </label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('Accounts.Kind_Of_Fees') }} </label>
                                <select class="custom-select mr-sm-2" name="Fee_type">
                                    <option value="1">{{ trans('Accounts.Study_fees') }} </option>
                                    <option value="2">  {{ trans('Accounts.Bus_Fee') }}</option>
                                </select>
                            </div>
                

                        </div>
                        

                        <div class="form-group">
                            <label for="inputAddress">{{ trans('grades_trans.Notes') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{$fee->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-success  nextBtn btn-lg pull-right">{{ trans('Students_trans.submit') }}</button>

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

    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Classroom_id"]').empty();
                            $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endsection

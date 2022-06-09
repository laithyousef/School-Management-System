@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Students_trans.Edit_student_data')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.Edit_student_data')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form action="{{route('students.update','test')}}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{trans('Students_trans.personal_information')}}</h6><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                <input value="{{$students->getTranslation('name','ar')}}" type="text" name="name_ar"
                                    class="form-control">
                                <input type="hidden" name="id" value="{{$students->id}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Students_trans.name_en')}} : <span class="text-danger">*</span></label>
                                <input value="{{$students->getTranslation('name','en')}}" class="form-control"
                                    name="name_en" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Students_trans.email')}} : </label>
                                <input type="email" value="{{ $students->email }}" name="email" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('Students_trans.password')}} :</label>
                                <input value="{{ $students->password }}" type="password" name="password"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{trans('Students_trans.gender')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="gender_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($Genders as $Gender)
                                    <option value="{{$Gender->id}}" {{$Gender->id == $students->gender_id ? 'selected' :
                                        ""}}>{{ $Gender->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nal_id">{{trans('Students_trans.Nationality')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="nationalitie_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($nationalities as $nationality)
                                    <option value="{{ $nationality->id }}" {{$nationality->id ==
                                        $students->nationalitie_id ? 'selected' : ""}}>{{ $nationality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bg_id">{{trans('Students_trans.blood_type')}} : </label>
                                <select class="custom-select mr-sm-2" name="blood_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($blood_types as $blood_type)
                                    <option value="{{ $blood_type->id }}" {{$blood_type->id == $students->blood_id ?
                                        'selected' : ""}}>{{ $blood_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{trans('Students_trans.Date_of_Birth')}} :</label>
                                <input class="form-control" type="text" value="{{$students->Date_Birth}}"
                                    id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd">
                            </div>
                        </div>

                    </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">
                        {{trans('Students_trans.Student_information')}}</h6><br>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($grades as $Grade)
                                    <option value="{{ $Grade->id }}" {{$Grade->id == $students->Grade_id ? 'selected' :
                                        ""}}>{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    @foreach($class_rooms as $class_room)
                                    <option value="{{$class_room->id}}" {{ $class_room->id == $students->Classroom_id ?
                                        'selected' : "" }}>{{ $class_room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="section_id">
                                    @foreach($sections as $section)
                                    <option value="{{$section->id}}" {{ $section->id == $students->section_id ?
                                        'selected' : ""}} > {{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="parent_id">{{trans('Students_trans.parent')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="parent_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ $parent->id == $students->parent_id ?
                                        'selected' : ""}}>{{ $parent->Father_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @php
                                    $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++) <option
                                        value="{{ $year}}" {{$year==$students->academic_year ? 'selected' : ' '}}>{{
                                        $year }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <button class="btn btn-success  nextBtn btn-lg pull-right"
                        type="submit">{{trans('Students_trans.submit')}}</button>
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
                            $.each(data, function (key, value) {
                                $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
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
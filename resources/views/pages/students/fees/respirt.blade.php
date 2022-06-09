
<!--~~~~~ Start Preloader Area ~~~~~-->

@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Accounts.reciept') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Accounts.reciept') }} 
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title_area text-center pb-10">
                        <h2 style="font-family: 'Cairo', sans-serif;">الاشتراك في كورس برنامج المستشفيات</h2>
                        <h2 style="font-family: 'Cairo'; color: red;">تم اغلاق باب الحجز سيتم الاعلان قريبا </h2>
                    </div>
                  
                </div>
            </div>
        </div>
        <div class="contact_form_area bg_white mt-110">
           <div class="container">
               <div class="row" style="text-align: right">
                   <div class="col-lg-12">
                       <br> <br> <br>
                       <form action="" method="post" autocomplete="off">
                           @csrf
                           <div class="form-row">
                               <div class="form-group col-md-6">
                                   <label for="name">{{ trans('Accounts.Full_Name_AR') }}</label>
                                   <input type="text" class="form-control" value="{{ old('name') }}" id="name"
                                          name="name">
                                   @error('name')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                               <div class="form-group col-md-6">
                                   <label for="email">{{ trans('Students_trans.email') }}</label>
                                   <input type="email" class="form-control" value="{{ old('email') }}" id="email"
                                          name="email">
                                   @error('email')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-row">
                               <div class="form-group col-md-6">
                                   <label for="Qualification">{{ trans }}</label>
                                   <input type="text" class="form-control" value="{{ old('Qualification') }}"
                                          id="Qualification" name="Qualification">
                                            @error('Qualification')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                   @enderror
                               </div>

                               <div class="form-group col-md-6">
                                   <label for="phone">{{ trans('parent_trans.Phone_Mother') }}</label>
                                   <input type="text" class="form-control" name="phone"
                                          value="{{ old('phone') }}" id="phone">
                                   @error('phone')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                           </div>

                           <div class="form-row">
                               <div class="form-group col-md-6">
                                   <label for="Country">{{ trans('Accounts.Country') }}</label>
                                   <select id="Country" required name="Country" class="form-control"
                                           value="{{ old('Country') }}">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                           @foreach($nationalities as $nationality)
                                               <option  value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                           @endforeach
                                    
                                   </select>
                                   @error('Country')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                               <div class="form-group col-md-6">
                                   <label for="City">{{ trans('Accounts.city') }}</label>
                                   <input type="text" class="form-control" id="City" value="{{ old('City') }}"
                                          name="City">
                                   @error('City')
                                   <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                               </div>

                           </div>
                           <br>
                           <button type="submit" class="btn btn-success  nextBtn btn-lg pull-right">{{ trans('Accounts.register') }}</button><br>
                       </form>
                   </div>
               </div>
           </div>
        </div>
    {{-- <!--~./ end contact area ~--> --}}
</div>
<!--~~/. end site wrapper ~~-->
@endsection

@section('js')
    
@endsection

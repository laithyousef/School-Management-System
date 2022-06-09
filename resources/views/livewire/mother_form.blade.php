@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Mother')}}</label>
                        <input type="text" wire:model="Name_Mother" class="form-control">
                        @error('Name_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Name_Mother_en')}}</label>
                        <input type="text" wire:model="Name_Mother_en" class="form-control">
                        @error('Name_Mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Mother')}}</label>
                        <input type="text" wire:model="Job_Mother" class="form-control">
                        @error('Job_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.Job_Mother_en')}}</label>
                        <input type="text" wire:model="Job_Mother_en" class="form-control">
                        @error('Job_Mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.National_ID_Mother')}}</label>
                        <input type="text" wire:model="National_ID_Mother" class="form-control">
                        @error('National_ID_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Passport_ID_Mother')}}</label>
                        <input type="text" wire:model="Passport_ID_Mother" class="form-control">
                        @error('Passport_ID_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.Phone_Mother')}}</label>
                        <input type="text" wire:model="Phone_Mother" class="form-control">
                        @error('Phone_Mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <br>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('Parent_trans.Nationality_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Mother_id">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($nationalities as $Nationality)
                                <option value="{{$Nationality->id}}">{{$Nationality->name}}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Mother_id">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($blood_types as $blood_type)
                                <option value="{{$blood_type->id}}">{{$blood_type->name}}</option>
                            @endforeach
                        </select>
                        @error('Blood_Type_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('Parent_trans.Religion_Father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Mother_id">
                            <option selected>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                            @endforeach
                        </select>
                        @error('Religion_Mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Mother')}}</label>
                    <textarea class="form-control" wire:model="Address_Mother" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('Address_Mother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-danger  nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{trans('Parent_trans.Back')}}
                </button>

                @if($update_Mode)
                    <button class="btn btn-success ml-2 nextBtn btn-lg pull-right" wire:click="secondStepSubmit_edit"
                            type="button">{{trans('Parent_trans.Next')}}
                    </button>
                @else
                    <button class="btn btn-success ml-2 nextBtn btn-lg pull-right" type="button"
                            wire:click="secondStepSubmit">{{trans('Parent_trans.Next')}}</button>
                @endif

            </div>
        </div>
    </div>

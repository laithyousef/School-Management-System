<?php

namespace App\Http\Livewire;

use App\Models\Parents;
use Livewire\Component;
use App\Models\Religion;
use App\Models\Blood_Type;
use App\Models\Nationality;
use Livewire\WithFileUploads;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\Hash;


class AddParent extends Component
{
    use WithFileUploads;

    public $currentStep = 1 , $show_table = true, $update_Mode = true,
         $photos, $catchError, $successMessage, $Parent_id,
        // Father_INPUTS
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;

    public function render()
    {
        return view('livewire.add-parent',[
            'nationalities' => Nationality::all(),
            'religions' => Religion::all(),
            'blood_types' => Blood_Type::all(),
            'parents' => Parents::all(),
        ]);

    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'Email' => 'required|email|unique:parents,Email,id',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|numeric|unique:parents,Father_National_ID,' . $this->id,
            'Passport_ID_Father' => 'required|numeric|unique:parents,Father_Passport_ID,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ],[
            'Email.required' => trans('parent_trans.required'),
            'Email.email' => trans('parent_trans.email'),
            'Password.required' => trans('parent_trans.required'),
            'Name_Father.required' => trans('parent_trans.required'),
            'Name_Father_en.required' => trans('parent_trans.required'),
            'Job_Father.required' => trans('parent_trans.required'),
            'Job_Father_en.required' => trans('parent_trans.required'),
            'National_ID_Father.required' => trans('parent_trans.required'),
            'National_ID_Father.numeric' => trans('parent_trans.numeric'),
            'Passport_ID_Father.required' => trans('parent_trans.required'),
            'Passport_ID_Father.numeric' => trans('parent_trans.numeric'),
            'Phone_Father.required' => trans('parent_trans.required'),
            'Phone_Father.regex' => trans('parent_trans.regex'),
            'Nationality_Father_id.required' => trans('parent_trans.required'),
            'Blood_Type_Father_id.required' => trans('parent_trans.required'),
            'Religion_Father_id.required' => trans('parent_trans.required'),
            'Address_Father.required' => trans('parent_trans.required'),
        ]);
        
        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|numeric|unique:parents,Mother_National_ID,' . $this->id,
            'Passport_ID_Mother' => 'required|numeric|unique:parents,Mother_Passport_ID,' . $this->id,
            'Phone_Mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ], [
            'Name_Mother.required' => trans('parent_trans.required'),
            'Name_Mother_en.required' => trans('parent_trans.required'),
            'National_ID_Mother.required' => trans('parent_trans.required'),
            'National_ID_Mother.numeric' => trans('parent_trans.numeric'),
            'Passport_ID_Mother.required' => trans('parent_trans.required'),
            'Passport_ID_Mother.numeric' => trans('parent_trans.numeric'),
            'Phone_Mother.required' => trans('parent_trans.required'),
            'Phone_Mother.regex' => trans('parent_trans.regex'),
            'Job_Mother.required' => trans('parent_trans.required'),
            'Job_Mother_en.required' => trans('parent_trans.required'),
            'Nationality_Mother_id.required' => trans('parent_trans.required'),
            'Blood_Type_Mother_id.required' => trans('parent_trans.required'),
            'Religion_Mother_id.required' => trans('parent_trans.required'),
            'Address_Mother.required' => trans('parent_trans.required'),
        
        ]);

        $this->currentStep = 3;
    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function show_add_form()
    {
        $this->show_table = false;
        $this->update_Mode = false;

    }

    public function return_to_menu()
    {
        $this->show_table = true;
        $this->clearForm();

    }


    public function submitForm()
    {
        try {

            $parent = new Parents();

            $parent->create([
                // Father data
                'Email' => $this->Email,
                'Password' => Hash::make($this->Password),
                'Father_Name' => ['ar' => $this->Name_Father, 'en' => $this->Name_Father_en],
                'Father_National_ID' => $this->National_ID_Father,
                'Father_Passport_ID' => $this->Passport_ID_Father,
                'Father_Phone' => $this->Phone_Father,
                'Father_Job' => ['ar' => $this->Job_Father, 'en' => $this->Job_Father_en],
                'Father_Nationality_id' =>  $this->Nationality_Father_id,
                'Father_Blood_Type_id' => $this->Blood_Type_Father_id,
                'Father_Religion_id' => $this->Religion_Father_id,
                'Father_Address' => $this->Address_Father,
                // Mother data
                'Mother_Name' => ['ar' => $this->Name_Mother, 'en' => $this->Name_Mother_en],
                'Mother_National_ID' => $this->National_ID_Mother,
                'Mother_Passport_ID' => $this->Passport_ID_Mother,
                'Mother_Phone' => $this->Phone_Mother,
                'Mother_Job' => ['ar' => $this->Job_Mother, 'en' => $this->Job_Mother_en],
                'Mother_Nationality_id' => $this->Nationality_Mother_id,
                'Mother_Blood_Type_id'  => $this->Blood_Type_Mother_id,
                'Mother_Religion_id' => $this->Religion_Mother_id,
                'Mother_Address' => $this->Address_Mother,
            ]);
            
           
            if(!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    
                    ParentAttachment::create([
                    'name' => $photo->getClientOriginalName(),
                    'parent_id' => $parent->latest()->first()->id,
                ]);
    
                $this->currentStep = 1 ;
                $this->clearForm();
                $this->successMessage = trans('messages.success');
    
                }
            }
        } catch (\Throwable $th) {
            $this->catchError = $th->getMessage();
            }
      
    }


    public function edit($id)
    {
        $parents = Parents::find($id);
      

    try {

        $this->show_table = false;
        $this->update_Mode = true;
              
        $this->Parent_id = $id;
        $this->Email = $parents->Email;
        $this->Password = $parents->Password;
        $this->Name_Father = $parents->getTranslation('Father_Name', 'ar');
        $this->Name_Father_en = $parents->getTranslation('Father_Name', 'en');
        $this->Job_Father = $parents->getTranslation('Father_Job', 'ar');;
        $this->Job_Father_en = $parents->getTranslation('Father_Job', 'en');
        $this->National_ID_Father =$parents->Father_National_ID;
        $this->Passport_ID_Father = $parents->Father_Passport_ID;
        $this->Phone_Father = $parents->Father_Phone;
        $this->Nationality_Father_id = $parents->Father_Nationality_id;
        $this->Blood_Type_Father_id = $parents->Father_Blood_Type_id;
        $this->Address_Father =$parents->Father_Address;
        $this->Religion_Father_id =$parents->Father_Religion_id;

        $this->Name_Mother = $parents->getTranslation('Mother_Name', 'ar');
        $this->Name_Mother_en = $parents->getTranslation('Mother_Name', 'en');
        $this->Job_Mother = $parents->getTranslation('Mother_Job', 'ar');;
        $this->Job_Mother_en = $parents->getTranslation('Mother_Job', 'en');
        $this->National_ID_Mother =$parents->Mother_National_ID;
        $this->Passport_ID_Mother = $parents->Mother_Passport_ID;
        $this->Phone_Mother = $parents->Mother_Phone; 
        $this->Nationality_Mother_id = $parents->Mother_Nationality_id;
        $this->Blood_Type_Mother_id = $parents->Mother_Blood_Type_id;
        $this->Address_Mother =$parents->Mother_Address;
        $this->Religion_Mother_id =$parents->Mother_Religion_id;
    } 
        catch (\Throwable $th) {
            $this->catchError = $th->getMessage();       
         }
       
    }

        
    
 
    public function firstStepSubmit_edit()
    {
        
        $this->validate([
            'Email' => 'required',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|numeric',
            'Passport_ID_Father' => 'required|numeric',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ],[
            'Email.required' => trans('parent_trans.required'),
            'Email.email' => trans('parent_trans.email'),
            'Password.required' => trans('parent_trans.required'),
            'Name_Father.required' => trans('parent_trans.required'),
            'Name_Father_en.required' => trans('parent_trans.required'),
            'Job_Father.required' => trans('parent_trans.required'),
            'Job_Father_en.required' => trans('parent_trans.required'),
            'National_ID_Father.required' => trans('parent_trans.required'),
            'National_ID_Father.numeric' => trans('parent_trans.numeric'),
            'Passport_ID_Father.required' => trans('parent_trans.required'),
            'Passport_ID_Father.numeric' => trans('parent_trans.numeric'),
            'Phone_Father.required' => trans('parent_trans.required'),
            'Phone_Father.regex' => trans('parent_trans.regex'),
            'Nationality_Father_id.required' => trans('parent_trans.required'),
            'Blood_Type_Father_id.required' => trans('parent_trans.required'),
            'Religion_Father_id.required' => trans('parent_trans.required'),
            'Address_Father.required' => trans('parent_trans.required'),
        ]);

        $this->update_Mode = true;
        $this->currentStep = 2;
    }

    public function secondStepSubmit_edit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|numeric',
            'Passport_ID_Mother' => 'required|numeric',
            'Phone_Mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ], [
            'Name_Mother.required' => trans('parent_trans.required'),
            'Name_Mother_en.required' => trans('parent_trans.required'),
            'National_ID_Mother.required' => trans('parent_trans.required'),
            'National_ID_Mother.numeric' => trans('parent_trans.numeric'),
            'Passport_ID_Mother.required' => trans('parent_trans.required'),
            'Passport_ID_Mother.numeric' => trans('parent_trans.numeric'),
            'Phone_Mother.required' => trans('parent_trans.required'),
            'Phone_Mother.regex' => trans('parent_trans.regex'),
            'Job_Mother.required' => trans('parent_trans.required'),
            'Job_Mother_en.required' => trans('parent_trans.required'),
            'Nationality_Mother_id.required' => trans('parent_trans.required'),
            'Blood_Type_Mother_id.required' => trans('parent_trans.required'),
            'Religion_Mother_id.required' => trans('parent_trans.required'),
            'Address_Mother.required' => trans('parent_trans.required'),
        ]);

        $this->update_Mode = true;
        $this->currentStep = 3;

    }

    public function submitForm_edit()
    {

        try {
            if($this->Parent_id) {

            $parents = Parents::find($this->Parent_id);

            $parents->update([

                // Father data
                'Email' => $this->Email,
                'Password' => Hash::make($this->Password),
                'Father_Name' => ['ar' => $this->Name_Father, 'en' => $this->Name_Father_en],
                'Father_National_ID' => $this->National_ID_Father,
                'Father_Passport_ID' => $this->Passport_ID_Father,
                'Father_Phone' => $this->Phone_Father,
                'Father_Job' => ['ar' => $this->Job_Father, 'en' => $this->Job_Father_en],
                'Father_Nationality_id' =>  $this->Nationality_Father_id,
                'Father_Blood_Type_id' => $this->Blood_Type_Father_id,
                'Father_Religion_id' => $this->Religion_Father_id,
                'Father_Address' => $this->Address_Father,
                // Mother data
                'Mother_Name' => ['ar' => $this->Name_Mother, 'en' => $this->Name_Mother_en],
                'Mother_National_ID' => $this->National_ID_Mother,
                'Mother_Passport_ID' => $this->Passport_ID_Mother,
                'Mother_Phone' => $this->Phone_Mother,
                'Mother_Job' => ['ar' => $this->Job_Mother, 'en' => $this->Job_Mother_en],
                'Mother_Nationality_id' => $this->Nationality_Mother_id,
                'Mother_Blood_Type_id'  => $this->Blood_Type_Mother_id,
                'Mother_Religion_id' => $this->Religion_Mother_id,
                'Mother_Address' => $this->Address_Mother,
           ]);
        }
   
           return redirect()->to('/add_parent');
           $this->successMessage = trans('messages.success');

        } catch (\Throwable $th) {

            $this->catchError = $th->getMessage();       
        }
    }


     //clearForm
     public function clearForm()
     {
         $this->Email = '';
         $this->Password = '';
         $this->Name_Father = '';
         $this->Job_Father = '';
         $this->Job_Father_en = '';
         $this->Name_Father_en = '';
         $this->National_ID_Father ='';
         $this->Passport_ID_Father = '';
         $this->Phone_Father = '';
         $this->Nationality_Father_id = '';
         $this->Blood_Type_Father_id = '';
         $this->Address_Father ='';
         $this->Religion_Father_id ='';
 
         $this->Name_Mother = '';
         $this->Job_Mother = '';
         $this->Job_Mother_en = '';
         $this->Name_Mother_en = '';
         $this->National_ID_Mother ='';
         $this->Passport_ID_Mother = '';
         $this->Phone_Mother = '';
         $this->Nationality_Mother_id = '';
         $this->Blood_Type_Mother_id = '';
         $this->Address_Mother ='';
         $this->Religion_Mother_id ='';
 
     }
 

     public function delete($id)
     {
         $parents = parents::find($id)->delete();
         return redirect()->to('/add_parent');
 
     }
}
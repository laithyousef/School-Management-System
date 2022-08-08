<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Teacher::findOrFail(auth()->user()->id);
        return view('pages.teachers.dashboard.profile.index', compact('information'));
    }


    public function update(Request $request, $id)
    {
        $information = Teacher::findorFail($id);

        if (!empty($request->password)) {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.update'));
        return redirect()->back();
    }
}

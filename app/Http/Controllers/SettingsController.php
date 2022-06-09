<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\AttachFilesTrait;


class SettingsController extends Controller
{
    use AttachFilesTrait;
    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });

        return view('pages.settings.index', $setting);
    }


    public function update(Request $request)
    {
        try {
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key => $value) {
                Setting::where('key', $key)->update([ 'value' =>  $value ]);
            }

            if ($request->hasfile('logo')) {
                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]);
                $this->upload_file($request, 'logo', 'logo');
            }

        
            toastr()->info(trans('messages.update'));
            return back();
        } catch (\Exception $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}

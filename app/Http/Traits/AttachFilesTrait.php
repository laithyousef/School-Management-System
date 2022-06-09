<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;



trait AttachFilesTrait
{
    
    public function upload_file($request, $file_name, $folder)
    {
        $file = $request->file($file_name)->getClientOriginalName();
        $request->file($file_name)->storeAs('attachments/', $folder . '/' . $file, 'upload_attachments');
    }


    public function delete_file($file_name)
    {
        $exists = Storage::disk('upload_attachments')->exists('attachments/library/'. $file_name);

        if($exists) {

            Storage::disk('upload_attachments')->delete('attachments/library/'. $file_name);
        }
    }
}
<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class UploadFile
{
    public static function file_upload($path, $request_file, $file_old = '')
    {
        if ($request_file) {
            
            if ($file_old) {
                Storage::disk("local")->delete($file_old);
            }

            $file_name      = explode(".", $request_file->getClientOriginalName())[0];
            $file_extension = $request_file->getClientOriginalExtension();
            $name           = $file_name.'_'.time() . '_' . '.' . $file_extension;
            Storage::putFileAs( 'public/'.$path, $request_file, $name);

            return $path . '/' . $name;
        }
    }

    public static function file_delete($file_name)
    {
        if ($file_name && Storage::exists( 'public/'.$file_name)) {
            Storage::delete('public/'.$file_name);
        }
    }

    public static function files_delete(array $files_name)
    {
        foreach ($files_name as  $file_name) {
            if ($file_name && Storage::exists( 'public/'.$file_name)) {
                Storage::delete('public/'.$file_name);
            }
        }
    }
    
}
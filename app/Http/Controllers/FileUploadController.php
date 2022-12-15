<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Images;
use File;

class FileUploadController extends Controller
{
    function fileUpload(Request $request, $id) {
        $file = $request->file('file');

        if($file){
            $uniqueCode = md5(uniqid(rand(), true));
            $file_name  = $request->type.'-'.$uniqueCode.'-'.$file->getClientOriginalName();
            $file_type  = $file->getClientOriginalExtension();
            $fileLocation = $file->move('images', $file_name);
            
            
            return Images::create([
                'foreign_id' => $id,
                'path' => $fileLocation,
                'type' => $request->type,
            ]);
        }
    }

    function files(Request $request, $id){
        $media = Images::where(['foreign_id' => $id])->latest()->get();
        foreach($media as $item){
            $item['path'] = asset(''.$item['path']);
        }
        return response()->json($media);
    }

    function fileDelete($id){
        $data = Images::where(['id' => $id])->first();
        
        if (File::exists(public_path($data->path)))
        {

            // delete database data
            if(Images::where(['id' => $id])->delete()){
                $status = File::delete(public_path($data->path));
                return response()->json($status);
            }

            return response()->json(['status'=> false]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TinymceImageUploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = url('/uploads/').'/'.$file->getClientOriginalName();
        $imgpath = $file->move(public_path('/uploads/'),$file->getClientOriginalName());
        $fileNameToStore = $path;

        return json_encode(['location' => $fileNameToStore]);
    }
}

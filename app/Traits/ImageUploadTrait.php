<?php

namespace App\Traits;
use Image;
use Illuminate\Http\Request;

trait ImageUploadTrait{
    /**
    * @param Request $request
    * @return $this|false|string
    */
    public function verifyAndUpload(Request $request,$fieldname='image',$directory='/storage/storage')
    {
                if($request->hasFile($fieldname)){
                        if(!$request->file($fieldname)->isValid()){
                   flash('Invalid Image')->error()->important();

            return redirect()->back()->withInput();
        }
            if($request->hasfile($fieldname)){
            //Get filename with extention
                $originalImage = $request->file($fieldname);
                $filenameWithExt = $originalImage->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $originalImage->getClientOriginalExtension();
                $featuredImage = Image::make($originalImage->getRealPath())->resize(760,421);
                $waterMark = Image::make(public_path('/static/logo.png'))->resize(40,40)->opacity(50);
                $featuredImage->insert($waterMark,'bottom-right', 3, 3);
                $featuredImage->text('© 2020-2023 magnificcoding.com - All Rights Reserved', 150, 30, function($font) { 
                $font->size(24);  
                $font->color([255, 255, 255, 0.9]);  
                $font->align('center');  
                $font->valign('top');  
                $font->angle(90);  
                });
                $featuredImagePath = public_path().$directory;
                $featuredImage->save($featuredImagePath.$filename.'_'.time().'.'.$extension);
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
                return $fileNameToStore;
               }
        }

                return null;
    }
}
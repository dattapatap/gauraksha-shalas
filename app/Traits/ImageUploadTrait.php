<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

trait ImageUploadTrait {


    public function uploadImage(Request $request, $inputName, $path, $width ,$height)
    {
        if($request->hasFile($inputName)){
            if(!Storage::disk('public')->exists($path)){
                Storage::disk('public')->makeDirectory($path, 0775, true);                 ;
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $fileName = time().'_'.uniqid().'.'.$ext;
            if($height != 0){

                $backgorund = Image::canvas($width, $height, '#ffffff');

                if($ext == 'webp'){
                    $request->file($inputName)->storeAs('public/'.$path,  $fileName);
                }else{
                    $imgFile = Image::make($image->getRealPath());
                    $imgFile->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $imgFile->stream();
                    $backgorund->insert($imgFile, 'center');
                    $backgorund->save(storage_path('/app/public/' .$path. '/' .$fileName));
                }

            }else{
              $request->file($inputName)->storeAs('public/icons',$fileName);
            }
            return $path.'/'.$fileName;
       }

    }


    public function uploadVideo(Request $request, $inputName, $path)
    {
        if($request->hasFile($inputName)){
            if(!Storage::disk('public')->exists($path)){
                Storage::disk('public')->makeDirectory($path, 0775, true);                 ;
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $fileName = time().'_'.uniqid().'.'.$ext;

            $request->file($inputName)->storeAs('public/'.$path,  $fileName);
            return $path.'/'.$fileName;
       }

    }



    public function uploadMultiImage(Request $request, $inputName, $path)
    {
        $imagePaths = [];

        if($request->hasFile($inputName)){

            $images = $request->{$inputName};

            foreach($images as $image){

                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_'.uniqid().'.'.$ext;

                $image->move(public_path($path), $imageName);

                $imagePaths[] =  $path.'/'.$imageName;
            }

            return $imagePaths;
       }
    }


    public function updateImage(Request $request, $inputName, $path, $width, $height, $oldPath=null)
    {
        if($request->hasFile($inputName)){

            if(!Storage::disk('public')->exists($path)){
                Storage::disk('public')->makeDirectory($path, 0775, true);                 ;
            }

            if($oldPath && File::exists(Storage::disk('public')->path($oldPath))){
                File::delete(Storage::disk('public')->path($oldPath));
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $fileName = time().'_'.uniqid().'.'.$ext;

            if($width != 0){
                if($ext == 'webp'){
                    $request->file($inputName)->storeAs('public/'.$path,  $fileName);
                }else{
                    $backgorund = Image::canvas($width, $height, '#ffffff');
                    $imgFile = Image::make($image->getRealPath());
                    $imgFile->resize($width, $height, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    });
                    $imgFile->stream();

                    // $backgorund->mask($mask);
                    $backgorund->insert($imgFile, 'center');
                    $backgorund->save(storage_path('/app/public/' .$path. '/' .$fileName));
                }
            }else{
              $request->file($inputName)->storeAs('public/icons',$fileName);
            }
            return $path.'/'.$fileName;
       }
    }


    /** Handle Delte File */
    public function deleteImage(string $path)
    {
        if(File::exists( Storage::disk('public')->path($path) )){
            File::delete(Storage::disk('public')->path($path));
        }
    }
}


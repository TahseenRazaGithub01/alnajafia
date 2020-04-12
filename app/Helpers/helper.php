<?php

namespace App\Helpers;
use Image;
use Session;

class Helper{

    public static function upload_image($originalImage){

        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/images/';
        $randomString = hexdec(uniqid());
        $thumbnailImage->save($originalPath.$randomString.$originalImage->getClientOriginalName());
        $thumbnailImage->resize(100,100);
        $thumbnailImage->save($thumbnailPath.$randomString.$originalImage->getClientOriginalName()); 
        $imageName = $randomString.$originalImage->getClientOriginalName();

        return $imageName;

    }

    public static function upload_image_for_banner($originalImage){

        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/images/';
        $randomString = hexdec(uniqid());
        $thumbnailImage->save($originalPath.$randomString.$originalImage->getClientOriginalName());
        $thumbnailImage->resize(200,100);
        $thumbnailImage->save($thumbnailPath.$randomString.$originalImage->getClientOriginalName()); 
        $imageName = $randomString.$originalImage->getClientOriginalName();

        return $imageName;

    }

    public static function check_lang(){
        if (!Session::has('locale')){
            Session::put('locale', 'en');
        }
    }
    
}
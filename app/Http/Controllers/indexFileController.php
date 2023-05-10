<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class indexFileController extends Controller
{
    public function indexFile(){
        $ImgConverter = app('App\Http\Controllers\ImgConverterController');

        if($_FILES){
            $upload = $ImgConverter::upload_image($_FILES, 'uploads', 'fileToUpload');
            
            if($upload){
                $imageName = urlencode($upload[0]);
                $imageType = urlencode($upload[1]);
                
                if($imageType == 'jpeg'){
                    $imageType = 'jpg';
                }
                echo $imageName;

                return view('converter.convert', ['imageName' => $imageName, 'imageType' => $imageType]);

            }
        }
    }
}


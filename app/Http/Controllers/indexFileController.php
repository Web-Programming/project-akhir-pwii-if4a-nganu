<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ImgConverterController;

class indexFileController extends Controller
{
    public function indexFile()
    {
        $ImgConverter = new ImgConverterController();

        if ($_FILES) {
            $upload = $ImgConverter->uploadImage($_FILES, 'uploads', 'fileToUpload');

            if ($upload) {
                $imageName = $upload[0];
                $imageType = $upload[1];

                if ($imageType == 'jpeg') {
                    $imageType = 'jpg';
                }
                echo $imageName;

                return view('converter.convert', ['imageName' => $imageName, 'imageType' => $imageType]);
            }
        }
    }
}
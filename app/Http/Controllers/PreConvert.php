<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreConvert extends Controller
{
    public function convert(Request $request)
    {
        $Converter = app('App\Http\Controllers\ImgConverterController');

        $convert_type = $request->input('convert_type');
        $imageName = $request->query('imageName');

        //create object of image converter class
        $target_dir = 'uploads';

        //convert image to the specified type
        $image = $Converter::convert_image($convert_type, $target_dir, $imageName);

        //if converted activate download link
        if ($image) {
            return view('converter.Converted', [
                'convert_type' => ucfirst($convert_type),
                'target_dir' => $target_dir,
                'image' => $image,
                'imageName' => $imageName
            ]);
        } else {
            return back()->withInput()->withErrors(['error' => 'Failed to convert image']);
        }
    }
}

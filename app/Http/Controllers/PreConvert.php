<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ImgConverterController;

class PreConvert extends Controller
{
    public function convert(Request $request)
    {
        $Converter = new ImgConverterController();

        $convertType = $request->input('convert_type');
        $imageName = $request->query('imageName');

        $targetDir = 'uploads';

        // Convert image to the specified type
        $image = $Converter->convertImage($convertType, $targetDir, $imageName);

        // Get only name
        $onlyName = $Converter->removeExtensionFromImage($imageName);

        // If converted, activate download link
        if ($image) {
            return view('converter.Converted', [
                'convert_type' => ucfirst($convertType),
                'target_dir' => $targetDir,
                'image' => $image,
                'imageName' => $imageName,
                'only_name' => $onlyName
            ]);
        } else {
            return back()->withInput()->withErrors(['error' => 'Failed to convert image']);
        }
    }
}
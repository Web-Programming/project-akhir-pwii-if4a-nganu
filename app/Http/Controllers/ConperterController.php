<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\TbImage;
use Illuminate\Support\Facades\File; 
use App\Http\Controllers\ImgConverterController;


class ConperterController extends Controller
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
                return view('converter.convert', ['imageName' => $imageName, 'imageType' => $imageType]);
            }
        }
    }

    public function dwnController(){
        $file_path = $_GET['filepath'];
        return Response::download(public_path($file_path));
    }

    public function hapusFoto($nama){
        TbImage::where('nama', $nama)->delete();
        File::delete(public_path('uploads/' . $nama));

        // Optionally, you can redirect back or return a response
        return redirect()->back()->with('message', 'Foto berhasil dihapus.');
    
    }

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

    public function indexCtr($tipe){
        return view('converter.index', ['tipe' => $tipe]);
    }
}

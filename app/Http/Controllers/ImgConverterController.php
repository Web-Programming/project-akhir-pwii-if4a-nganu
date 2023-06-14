<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Models\TbImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class ImgConverterController extends Controller
{
    public static function convertImage($convertType, $targetDir, $imageName, $imageQuality = 100)
    {
        $targetDir = public_path('/' . $targetDir . '/');
        $targetDir = "$targetDir/";

        $image = $targetDir . $imageName;

        // Remove extension from image;
        $imgName = static::removeExtensionFromImage($image);

        // Convert to png
        if ($convertType === 'png') {
            $binary = imagecreatefromstring(file_get_contents($image));
            // Third parameter for ImagePng is limited to 0 to 9
            // 0 is uncompressed, 9 is compressed
            // Convert 100 to 2 digit number by dividing it by 10 and subtracting 10
            $imageQuality = floor(10 - ($imageQuality / 10));
            imagepng($binary, $targetDir . $imgName . '.' . $convertType, $imageQuality);
            static::store(request(), $imgName . '.' . $convertType);

            File::delete($imgName);
            return $imgName . '.' . $convertType;
        }

        // Convert to jpg
        if ($convertType === 'jpg') {
            // Load gambar nya
            $binary = imagecreatefromstring(file_get_contents($image));
            // $image = imagecreatefrompng(file_get_contents($binary));

            // Buat nama JPG baru
            $new_name = $imgName . ".jpg";

            // Membuat gambar jpg berwarna putih yang berukuran sama dengan png
            $jpg_image = imagecreatetruecolor(imagesx($binary), imagesy($binary));
            $white = imagecolorallocate($jpg_image, 255, 255, 255);
            imagefill($jpg_image, 0, 0, $white);

            // Timpa gambar putih dengan PNG agar jika ada bagian transparentnya background menjadi putih
            imagecopy($jpg_image, $binary, 0, 0, 0, 0, imagesx($binary), imagesy($binary));
            imagejpeg($jpg_image, $targetDir . $imgName . '.' . $convertType, $imageQuality);

            static::store(request(), $imgName . '.' . $convertType);

            // imagejpeg($binary, $targetDir . $imgName . '.' . $convertType, $imageQuality);
            File::delete($image);


            return $imgName . '.' . $convertType;
        }

        if ($convertType === 'gif') {
            // Load gambar nya
            $binary = imagecreatefromstring(file_get_contents($image));
            // $image = imagecreatefrompng(file_get_contents($binary));

            // Buat nama JPG baru
            $new_name = $imgName . ".gif";

            // Membuat gambar jpg berwarna putih yang berukuran sama dengan png
            $gif_image = imagecreatetruecolor(imagesx($binary), imagesy($binary));
            $white = imagecolorallocate($gif_image, 255, 255, 255);
            imagefill($gif_image, 0, 0, $white);

            // Timpa gambar putih dengan PNG agar jika ada bagian transparentnya background menjadi putih
            imagecopy($gif_image, $binary, 0, 0, 0, 0, imagesx($binary), imagesy($binary));

            imagegif($gif_image, $targetDir . $imgName . '.' . $convertType);
            static::store(request(), $imgName . '.' . $convertType);

            File::delete($image);
            return $imgName . '.' . $convertType;
        }

        if ($convertType === 'webp') {
            $binary = imagecreatefromstring(file_get_contents($image));
            imagewebp($binary, $targetDir . $imgName . '.' . $convertType);
            static::store(request(), $imgName . '.' . $convertType);

            File::delete($image);
            return $imgName . '.' . $convertType;
        }

        return false;
    }

    public static function uploadImage($files, $targetDir, $inputName)
    {
        $targetDir = public_path('/' . $targetDir . '/');

        $targetDir = "$targetDir/";

        // Get the basename of the uploaded file
        $baseName = basename($files[$inputName]["name"]);

        // Get the image type from the uploaded image
        $imageFileType = static::getImageType($baseName);

        // Set dynamic name for the uploaded file
        $newName = static::getDynamicName($baseName, $imageFileType);

        // Set the target file for uploading
        $targetFile = $targetDir . $newName;

        // Check if uploaded file is a valid image
        // $validate = static::validateImage($files[$inputName]["tmp_name"]);
        // if (!$validate) {
        //     echo "Doesn't seem like an image file :(";
        //     return false;
        // }

        // Check file size - restrict if greater than 10 MB
        $fileSize = static::checkFileSize($files[$inputName]["size"], 10000000);
        if (!$fileSize) {
            echo "You cannot upload more than 1MB file";
            return false;
        }

        // Allow certain file formats
        $fileType = static::checkOnlyAllowedImageTypes($imageFileType);
        if (!$fileType) {
            echo "You cannot upload other than JPG, JPEG, WEBP, and PNG";
            return false;
        }

        if (move_uploaded_file($files[$inputName]["tmp_name"], $targetFile)) {
            // Return new image name and image file type
            return array($newName, $imageFileType);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    public static function store(Request $request, $filename)
    {
        // Menghasilkan path penyimpanan baru
        $path = 'public/uploads/'. $filename;

        // Mendapatkan ID pengguna yang saat ini masuk
        $userId = Auth::id();

        // Membuat entri baru di database dengan mengisi id_user
        TbImage::create([
            'nama' => $filename,
            'path' => $path,
            'id_user' => $userId,
        ]);

        return "Foto berhasil disimpan di database.";
    }


    public static function getImageType($targetFile)
    {
        $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);
        return $imageFileType;
    }
    public static function validateImage($file)
    {
        $check = getimagesize($file);
        if ($check !== false) {
            return true;
        }
        return false;
    }

    public static function checkFileSize($file, $sizeLimit)
    {
        if ($file > $sizeLimit) {
            return false;
        }
        return true;
    }

    public static function checkOnlyAllowedImageTypes($imageType)
    {
        if (
            $imageType != "jpg"
            && $imageType != "png"
            && $imageType != "jpeg"
            && $imageType != "gif"
            && $imageType != "webp"
            && $imageType != "HEIC"

        ) {
            return false;
        }
        return true;
    }

    public static function getDynamicName($basename, $imageType)
    {
        $onlyName = basename($basename, '.' . $imageType); // Remove extension
        $combineTime = $onlyName . '_' . time();
        $newName = $combineTime . '.' . $imageType;
        return $newName;
    }

    public static function removeExtensionFromImage($image)
    {
        $extension = static::getImageType($image); // Get extension
        $onlyName = basename($image, '.' . $extension); // Remove extension
        return $onlyName;
    }
}

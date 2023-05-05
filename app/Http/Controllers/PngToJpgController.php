<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PngToJpgController extends Controller
{
    public function index()
    {
      if(isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    
        // Cek apakah png
        if(strtolower($file_ext) === 'png') {
          // Load gambar PNG nya
          $image = imagecreatefrompng($file_tmp);
          
          // Buat nama JPG baru
          $arrName = explode(".", $file_name);
          $arrName[count($arrName) - 1] = ".jpg";
          $new_name = join("", $arrName);
    
          // Membuat gambar jpg berwarna putih yang berukuran sama dengan png
          $jpg_image = imagecreatetruecolor(imagesx($image), imagesy($image));
          $white = imagecolorallocate($jpg_image, 255, 255, 255);
          imagefill($jpg_image, 0, 0, $white);
          
          // Timpa gambar putih dengan PNG agar jika ada bagian transparentnya background menjadi putih
          imagecopy($jpg_image, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
          
    
          // Download file yang sudah jadi jpg
          header("Content-type: image/jpeg");
          header('Content-Disposition: attachment; filename="' . $new_name . '"');
          header("Pragma: no-cache");
          header("Expires: 0");
          imagejpeg($jpg_image, null, 75);
    
          imagedestroy($jpg_image);
          imagedestroy($image);
          exit;
        }
        else {
          echo 'Please upload a PNG file.';
        }
      }
    }
   
}

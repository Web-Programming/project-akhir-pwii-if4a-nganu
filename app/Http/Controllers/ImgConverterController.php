<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImgConverterController extends Controller
{
    public static function convert_image($convert_type, $target_dir, $image_name, $image_quality=100){
        $target_dir = public_path('/'.$target_dir.'/');
		$target_dir = "$target_dir/";
		
		$image = $target_dir.$image_name;
		
		//remove extension from image;
		$img_name = static::remove_extension_from_image($image);
		
		//to png
		if($convert_type == 'png'){
			$binary = imagecreatefromstring(file_get_contents($image));
			//third parameter for ImagePng is limited to 0 to 9
			//0 is uncompressed, 9 is compressed
			//so convert 100 to 2 digit number by dividing it by 10 and minus with 10
			$image_quality = floor(10 - ($image_quality / 10));
			ImagePNG($binary, $target_dir.$img_name.'.'.$convert_type, $image_quality);
			return $img_name.'.'.$convert_type;
		}
		
		//to jpg
		if($convert_type == 'jpg'){
			$binary = imagecreatefromstring(file_get_contents($image));
			imageJpeg($binary, $target_dir.$img_name.'.'.$convert_type, $image_quality);
			return $img_name.'.'.$convert_type;
		}		
		if($convert_type == 'gif'){
			$binary = imagecreatefromstring(file_get_contents($image));
			imagegif($binary, $target_dir.$img_name.'.'.$convert_type);
			return $img_name.'.'.$convert_type;
		}
		if($convert_type == 'webp'){
			$binary = imagecreatefromstring(file_get_contents($image));
			imagewebp($binary, $target_dir.$img_name.'.'.$convert_type);
			return $img_name.'.'.$convert_type;
		}

		return false; 
	}


    public static function upload_image($files, $target_dir, $input_name){
        $target_dir = public_path('/'.$target_dir.'/');
		
		$target_dir = "$target_dir/";
		
		//get the basename of the uploaded file
		$base_name = basename($files[$input_name]["name"]);

		//get the image type from the uploaded image
		$imageFileType = static::get_image_type($base_name);
		
		//set dynamic name for the uploaded file
		$new_name = static::get_dynamic_name($base_name, $imageFileType);
		
		//set the target file for uploading
		$target_file = $target_dir . $new_name;
	
		// Check uploaded is a valid image
		$validate = static::validate_image($files[$input_name]["tmp_name"]);
		if(!$validate){
			echo "Doesn't seem like an image file :(";
			return false;
		}
		
		// Check file size - restrict if greater than 10 MB 
		$file_size = static::check_file_size($files[$input_name]["size"], 10000000);
		if(!$file_size){
			echo "You cannot upload more than 1MB file";
			return false;
		}

		// Allow certain file formats
		$file_type = static::check_only_allowed_image_types($imageFileType);
		if(!$file_type){
			echo "You cannot upload other than JPG, JPEG, WEBP, and PNG";
			return false;
		}
		
		if (move_uploaded_file($files[$input_name]["tmp_name"], $target_file)) {
			//return new image name and image file type;
			return array($new_name, $imageFileType);
		} else {
			echo "Sorry, there was an error uploading your file.";
		}

	}
	
	public static function get_image_type($target_file){
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		return $imageFileType;
	}
	
	public static function validate_image($file){
		$check = getimagesize($file);
		if($check !== false) {
			return true;
		} 
		return false;
	}
	
	public static function check_file_size($file, $size_limit){
		if ($file > $size_limit) {
			return false;
		}
		return true;
	}
	
	public static function check_only_allowed_image_types($imagetype){
		if($imagetype != "jpg" && $imagetype != "png" && $imagetype != "jpeg " && $imagetype != "gif" && $imagetype != "webp") {
			return false;
		}
		return true;
	}
	
	public static function get_dynamic_name($basename, $imagetype){
		$only_name = basename($basename, '.'.$imagetype); // remove extension
		$combine_time = $only_name.'_'.time();
		$new_name = $combine_time.'.'.$imagetype;
		return $new_name;
	}
	
	public static function remove_extension_from_image($image){
		$extension = static::get_image_type($image); //get extension
		$only_name = basename($image, '.'.$extension); // remove extension
		return $only_name;
	}
}

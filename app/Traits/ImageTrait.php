<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

trait ImageTrait{


    public function saveImage($file){
		$watermark = false;
		$path = public_path('/images'); // set images path
		$fileExtension = $file->getClientOriginalExtension(); // get file extension
		$fileName = time() . Str::random(10) . '.' . $fileExtension; // set the file name
        
        $image = Image::make($file);
        $imageHeight = $image->height(); // get the image height

        // resize the image if height > 200px
        if($imageHeight > 200){
            $image = $this->resizeImage($image, null, 200);
        }
		
		// add watermark
		if($watermark && file_exists(public_path('/watermark.png'))){
			$image->insert(public_path('/watermark.png')); 
		}
		
		// save image
        $image->save($path.'/'.$fileName); 
		
        return $fileName;
    } 

    public function deleteImage($fileName){
        $path = public_path($articlesPath . '.' . $fileName);
        if(file_exists($path))
            File::delete($path);
    }

    public function updateImage($file, $oldFileName = null){
        $fileName = $this->saveImage($file);
        if($oldFileName != null)
            $this->deleteImage($oldFileName);
        return $fileName;
    }

    private function resizeImage($image, $width, $height){
        return $image->resize($width, $height, function($constraint) {
           $constraint->aspectRatio();
        });
    }

}
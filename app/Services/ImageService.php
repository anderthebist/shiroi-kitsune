<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ImageService {
    public function upload($image, $directory) {
        $fileName = time().'-'.$image->getClientOriginalName();  
        $image->move(public_path($directory), $fileName);

        return $fileName;
    }

    public function uploadMany($images = [], $directory) {
        $imagesData = [];

        foreach($images as $key=>$image) {
            $imagesData[$key] = $this->upload($image, $directory);
        }

        return $imagesData;
    }

    public function delete($path) {
        File::delete(public_path($path));
    }
}
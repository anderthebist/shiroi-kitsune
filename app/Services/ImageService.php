<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ImageService {
    public function upload($image, $directory) {
        $fileName = time().'.'.$image->extension();  
        $image->move(public_path($directory), $fileName);

        return "/{$directory}/{$fileName}";
    }

    public function delete($path) {
        File::delete(public_path($path));
    }
}
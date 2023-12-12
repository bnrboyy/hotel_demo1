<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function uploadImage($folderPath = "upload/", $image = NULL, $preName = "", $postName = "", $customName = NULL) {

        if ($image) {
            /* checking folder */
            if (!file_exists($folderPath)) {
                File::makeDirectory($folderPath, $mode = 0777, true, true);
            }

            $extName = "." . $image->extension(); // .jpg, .jpeg, .png
            $name = time();
            $fullName = $preName . $name . $postName;
            $newImageName = $fullName . $extName; //product123544536456.png

            if ($image->move($folderPath, $newImageName)) {
                return $folderPath . $newImageName; // upload/productimg/product123544536456.png
            }
        } else {
            return false;
        }
    }
}

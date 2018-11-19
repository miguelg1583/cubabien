<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ImagenController extends Controller
{
    /**
     * @param string $path
     * @param null $width
     * @param null $height
     * @param string $type
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getImageThumbnail($path, $width, $height, $type)
    {

        $images_path = FRONT_IMAGE_PATH;
        $path = ltrim($path, "/");

        //returns the original image if isn't passed width and height
        if (is_null($width) && is_null($height)) {
            return url("{$images_path}/" . $path);
        }

        //if thumbnail exist returns it
        if (File::exists(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path))) {
            return url("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path);
        }

        //If original image doesn't exists returns a default image which shows that original image doesn't exist.
        if (!File::exists(public_path("{$images_path}/" . $path))) {

            /*
             * 2 ways
             */

            //1. recursive call for the default image
            //return $this->getImageThumbnail("error/no-image.png", $width, $height, $type);

            //2. returns an image placeholder generated from placehold.it
            return "http://placehold.it/{$width}x{$height}";
        }

        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];
        $contentType = mime_content_type(public_path("{$images_path}/" . $path));

        if (in_array($contentType, $allowedMimeTypes)) { //Checks if is an image

            $image = Image::make(public_path("{$images_path}/" . $path));

            switch ($type) {
                case "fit": {
                    $image->fit($width, $height, function ($constraint) {
                        $constraint->upsize();
                    });
                    break;
                }
                case "resize": {
                    //stretched
                    $image->resize($width, $height);
                }
                case "background": {
                    $image->resize($width, $height, function ($constraint) {
                        //keeps aspect ratio and sets black background
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
                case "resizeCanvas": {
                    $image->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)'); //gets the center part
                }
            }

            //relative directory path starting from main directory of images
            $dir_path = (dirname($path) == '.') ? "" : dirname($path);

            //Create the directory if it doesn't exist
            if (!File::exists(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $dir_path))) {
                File::makeDirectory(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $dir_path), 0775, true);
            }

            //Save the thumbnail
            $image->save(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path));

            $image->insert($this->getWatermark($width, $height), 'bottom-right');

            $image->save(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . str_replace_last('.','_watermark.',$path)));

            //return the url of the thumbnail
            return url("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path);
        } else {

            //return a placeholder image
            return "http://placehold.it/{$width}x{$height}";
        }
    }

    public function getWatermark($width, $height){

        //returns the original image if isn't passed width and height
        if (is_null($width) && is_null($height)) {
            return public_path("/frontend/images/watermark.png");
        }

        //if thumbnail exist returns it
        if (File::exists(public_path("/frontend/images/thumbs/" . "{$width}x{$height}/watermark.png"))) {
            return public_path("/frontend/images/thumbs/" . "{$width}x{$height}/watermark.png");
        }

//        //If original image doesn't exists returns a default image which shows that original image doesn't exist.
//        if (!File::exists(public_path("{$images_path}/" . $path))) {
//
//            /*
//             * 2 ways
//             */
//
//            //1. recursive call for the default image
//            //return $this->getImageThumbnail("error/no-image.png", $width, $height, $type);
//
//            //2. returns an image placeholder generated from placehold.it
//            return "http://placehold.it/{$width}x{$height}";
//        }

//        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];
//        $contentType = mime_content_type(public_path("{$images_path}/" . $path));
//
//        if (in_array($contentType, $allowedMimeTypes)) { //Checks if is an image

            $image = Image::make(public_path("/frontend/images/watermark.png"));

//            switch ($type) {
//                case "fit": {
                    $image->fit($width, $height, function ($constraint) {
                        $constraint->upsize();
                    });
//                    break;
//                }
//                case "resize": {
//                    //stretched
//                    $image->resize($width, $height);
//                }
//                case "background": {
//                    $image->resize($width, $height, function ($constraint) {
//                        //keeps aspect ratio and sets black background
//                        $constraint->aspectRatio();
//                        $constraint->upsize();
//                    });
//                }
//                case "resizeCanvas": {
//                    $image->resizeCanvas($width, $height, 'center', false, 'rgba(0, 0, 0, 0)'); //gets the center part
//                }
//            }

            //relative directory path starting from main directory of images
//            $dir_path = (dirname($path) == '.') ? "" : dirname($path);

            //Create the directory if it doesn't exist
            if (!File::exists(public_path("/frontend/images/thumbs/" . "{$width}x{$height}"))) {
                File::makeDirectory(public_path("/frontend/images/thumbs/" . "{$width}x{$height}"), 0775, true);
            }

            //Save the thumbnail
            $image->save(public_path("/frontend/images/thumbs/" . "{$width}x{$height}/watermark.png"));

            //return the url of the thumbnail
            return public_path("/frontend/images/thumbs/" . "{$width}x{$height}/watermark.png");
    }
}

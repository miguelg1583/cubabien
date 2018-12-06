<?php

namespace App\Jobs;

use File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Image;


class ImagenGaleriaThumb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $imagen;

    /**
     * Create a new job instance.
     *
     * @param $imagen
     */
    public function __construct($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        \Log::info('Comenzando Job ImagenGaleriaThumb');

        $images_path = FRONT_IMAGE_PATH;
        $path = ltrim($this->imagen, "/");

        //if thumbnail not exist crearla
        if (!File::exists(public_path("frontend/images/thumbs/100x100/{$path}"))) {
            if (File::exists(public_path("{$images_path}/" . $path))) {
                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];
                $contentType = mime_content_type(public_path("{$images_path}/" . $path));

                if (in_array($contentType, $allowedMimeTypes)) { //Checks if is an image

                    $image = Image::make(public_path("{$images_path}/" . $path));

                    $image->fit(100, 100, function ($constraint) {
                        $constraint->upsize();
                    });

                    //Save the thumbnail
                    $image->save(public_path("frontend/images/thumbs/100x100/" . $path));
                }
            }
        }
//        \Log::info('Terminado Job ImagenGaleriaThumb');


    }
}

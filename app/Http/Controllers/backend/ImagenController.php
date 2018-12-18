<?php

namespace App\Http\Controllers\backend;

use App\ImagenPub;
use App\Jobs\ImagenGaleriaLarge;
use App\Jobs\ImagenGaleriaThumb;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class ImagenController extends Controller
{
    public function index_upload()
    {
//        $free = disk_free_space("/home/cubabien");
//        $total = disk_total_space("/home/cubabien");

//        return view('backend.imagenes.upload', compact('free', 'total'));
        return view('backend.imagenes.upload');
    }

    public function index_gallery()
    {
        $files = File::files(public_path('frontend/images/uploads'));
        $imagenes = [];
        foreach ($files as $file) {
//            getImageThumbnail($file->getFilename(),1360,768, 'fit');
//            getImageThumbnail($file->getFilename(),100,100, 'fit');
            $imagenes[] = $file->getFilename();
        }
//        dd($imagenes);
        return view('backend.imagenes.gallery', compact('imagenes'));
    }

    public function index_pub_home()
    {
        $images_home = ImagenPub::whereLugar('Home')->get(['imagen']);
        $files = File::files(public_path('frontend/images/uploads'));
        $images_files = [];
        foreach ($files as $file) {
            $images_files[] = $file->getFilename();
        }
        $images_db = [];
        foreach ($images_home as $img_db) {
            $images_db[] = ['imagen' => $img_db->imagen, 'encode' => getImageEncode($img_db->imagen, 700, 540)];
        }
        return view('backend.imagenes.pub_home', compact('images_db', 'images_files'));
    }

    public function home_publicar(Request $request)
    {
        ImagenPub::whereLugar('Home')->delete();
        foreach ($request->imagenes as $r_img) {
            ImagenPub::create(['imagen' => $r_img, 'lugar' => 'Home']);
        }
        return response()->json(['mensaje' => 'OK'], 200);
    }

    public function index_pub_tour()
    {
        $images_home = ImagenPub::whereLugar('Tour')->get(['imagen']);
        $files = File::files(public_path('frontend/images/uploads'));
        $images_files = [];
        foreach ($files as $file) {
            $images_files[] = $file->getFilename();
        }
        $images_db = [];
        foreach ($images_home as $img_db) {
            $images_db[] = ['imagen' => $img_db->imagen, 'encode' => getImageEncode($img_db->imagen, 700, 780)];
        }
        return view('backend.imagenes.pub_tour', compact('images_db', 'images_files'));
    }

    public function tour_publicar(Request $request)
    {
        ImagenPub::whereLugar('Tour')->delete();
        foreach ($request->imagenes as $r_img) {
            ImagenPub::create(['imagen' => $r_img, 'lugar' => 'Tour']);
        }
        return response()->json(['mensaje' => 'OK'], 200);
    }

    public function store(Request $request)
    {
        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = $photo->getClientOriginalName();
            if (!File::exists(public_path('frontend/images/uploads/') . $name)) {
                Image::make($photo)
                    ->save(public_path('frontend/images/uploads/') . $name);
            }
//            $imagen_auto = getImageThumbnail($photo->getClientOriginalName(), 1360, 768, 'fit');
            ImagenGaleriaThumb::dispatch($photo->getClientOriginalName());
            ImagenGaleriaLarge::dispatch($photo->getClientOriginalName());
        }
        return response()->json(['mensaje' => 'OK'], 200);
    }

    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $filename = $request->id;

        $file_path = public_path('frontend/images/uploads/') . $filename;

        if (file_exists($file_path)) {
            File::delete($file_path);
        }

        if (file_exists(public_path('frontend/images/thumbs/100x100/') . $filename)) {
            File::delete(public_path('frontend/images/thumbs/100x100/') . $filename);
        }

        if (file_exists(public_path('frontend/images/thumbs/1360x768/') . $filename)) {
            File::delete(public_path('frontend/images/thumbs/1360x768/') . $filename);
        }

        return response()->json(['mensaje' => 'OK'], 200);
    }

    public function getcode(Request $request)
    {
        try {
            $imagen = $request->imagen;
            $width = $request->width;
            $height = $request->height;
            $res = getImageEncode($imagen, $width, $height);

            return response()->json(['mensaje' => $res]);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }


    }
}

<?php

namespace App\Http\Controllers\backend;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class ImagenController extends Controller
{
    public function index_upload()
    {
        return view('backend.imagenes.upload');
    }

    public function index_gallery()
    {
        $files=File::files(public_path('frontend/images/uploads'));
        $imagenes = [];
        foreach ($files as $file) {
//            getImageThumbnail($file->getFilename(),1360,768, 'fit');
//            getImageThumbnail($file->getFilename(),100,100, 'fit');
            $imagenes[]=$file->getFilename();
        }
//        dd($imagenes);
        return view('backend.imagenes.gallery', compact('imagenes'));
    }

    public function store(Request $request)
    {
//        if ($request->file('file')) {
//            $image = $request->file('file');
//            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
//            Image::make($request->file('file'))->save(public_path('frontend/images/uploads') . $name);
//        }
//        return response()->json(['mensaje' => 'OK'], 200);
        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

//        if (!is_dir($this->photos_path)) {
//            mkdir($this->photos_path, 0777);
//        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
//            $name = sha1(date('YmdHis') . str_random(30));
            $name = $photo->getClientOriginalName();
//            $save_name = $name . '.' . $photo->getClientOriginalExtension();
//            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

            Image::make($photo)
//                ->resize(250, null, function ($constraints) {
//                    $constraints->aspectRatio();
//                })
                ->save(public_path('frontend/images/uploads/') . $name);

//            $photo->move($this->photos_path, $save_name);
//
//            $upload = new Upload();
//            $upload->filename = $save_name;
//            $upload->resized_name = $resize_name;
//            $upload->original_name = basename($photo->getClientOriginalName());
//            $upload->save();
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
//        $uploaded_image = Upload::where('original_name', basename($filename))->first();

//        if (empty($uploaded_image)) {
//            return Response::json(['message' => 'Sorry file does not exist'], 400);
//        }

        $file_path = public_path('frontend/images/uploads/').$filename;
//        $resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

//        if (file_exists($resized_file)) {
//            unlink($resized_file);
//        }
//
//        if (!empty($uploaded_image)) {
//            $uploaded_image->delete();
//        }

        return response()->json(['mensaje' => 'OK'], 200);
    }
}

<?php

namespace App\Http\Controllers\frontend;

use App\ImagenPub;
use App\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::with('fechas')->whereActivo(1)->get();
        $img_home = ImagenPub::whereLugar('Home')->get(['imagen']);
        $imgs = [];
        foreach ($img_home as $img) {
            $imgs[] = getImageThumbnail($img->imagen, 700, 540, 'fit');
        }
        return view('frontend.home', compact('tours', 'imgs'));
    }
}

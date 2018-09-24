<?php

namespace App\Http\Controllers\frontend;

use App\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::with('fechas')->get();

        return view('frontend.home', compact('tours'));
    }
}

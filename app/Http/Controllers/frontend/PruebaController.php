<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PruebaController extends Controller
{
    public function getRequestData(Request $request)
    {
        dd($request);
    }
}

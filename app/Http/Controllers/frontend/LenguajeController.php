<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LenguajeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeLanguaje(Request $request)
    {
        if($request->ajax()){
            $request->session()->put('locale', $request->lang);
            return response()->json(['mensaje' => 'OK']);
        }
    }
}

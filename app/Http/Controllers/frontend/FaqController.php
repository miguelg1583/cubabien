<?php

namespace App\Http\Controllers\frontend;

use App\CategoriaFaq;
use App\PreguntaResp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
//        $categorias = CategoriaFaq::all();
        $categorias = CategoriaFaq::with(['preguntas_resp'])->orderBy('visitas','dsc')->get();
//        $preguntas_resp = PreguntaResp::all();
//        return view('frontend.faqs.index', compact(['categorias','preguntas_resp']));
        return view('frontend.faqs.index', compact('categorias'));
    }

    public function addVisitaCateg(Request $request)
    {
        try {
            $categ = CategoriaFaq::findOrFail($request->id);
            $categ->visitas+=1;
            $categ->save();
            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function addVisitaPreg(Request $request)
    {
        try {
            $preg = PreguntaResp::findOrFail($request->id);
            $preg->visitas+=1;
            $preg->save();
            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function full()
    {
        $categorias = CategoriaFaq::with(['preguntas_resp'])->orderBy('visitas','dsc')->get();
        return view('frontend.faqs.full', compact('categorias'));

    }
}

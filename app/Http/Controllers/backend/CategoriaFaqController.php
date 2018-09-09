<?php

namespace App\Http\Controllers\backend;

use App\CategoriaFaq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\TranslationLoader\LanguageLine;

class CategoriaFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = CategoriaFaq::all();
        return view('backend.categoria_faq.index', compact(['categorias']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categoria_faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rcateg = $request->categoria;

            $categoria = new CategoriaFaq();
            $categoria->nb = $rcateg['nb']['valor'];
            $categoria->save();

            $id = $categoria->id;

            $categoria = CategoriaFaq::findOrFail($id);
            $categoria->nb_trad = guarda_trad('categoria-faq', $id, $rcateg['nb']['traduccion']['text']);
            $categoria->save();

            return response()->json(['mensaje' => 'OK']);


        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categ = CategoriaFaq::findOrFail($id);
        return view('backend.categoria_faq.edit', compact('categ'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rcateg = $request->categoria;
            $dbcateg = CategoriaFaq::findOrFail($id);
            $dbcateg->nb = $rcateg['nb']['valor'];
            $dbcateg->save();

            return response()->json(['mensaje' => 'OK']);


        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $categ = CategoriaFaq::findOrFail($id)->delete();
            if ($categ) return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }
}

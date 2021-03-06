<?php

namespace App\Http\Controllers\backend;

use App\MapaTour;
use App\Tour;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapaTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::has('mapa')->with('mapa')->get();
        return view('backend.mapa_tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tours = DB::table('tours')->selectRaw('tours.id, tours.nb as text')->get();
        return view('backend.mapa_tours.create', compact('tours'));
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
            $r_mapa_tour = $request->mapa_tour;
            foreach ($r_mapa_tour as $r_mapa) {
                $mapa = new MapaTour();
                $mapa->tour_id = $r_mapa['tour_id'];
                $mapa->latitud = $r_mapa['latitud'];
                $mapa->longitud = $r_mapa['longitud'];
                $mapa->etiqueta = $r_mapa['etiqueta']['valor'];
                $mapa->save();

                $id_mapa = $mapa->id;

//                $mapa = MapaTour::findOrFail($id_mapa);
                $mapa->etiqueta_trad = guarda_trad('mapa_etiqueta', $id_mapa, $r_mapa['etiqueta']['traduccion']['text']);
                $mapa->update();
            }

            return response()->json(['mensaje' => 'OK']);


        } catch (\Exception $e) {
            report($e);
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
        $tours = DB::table('tours')->selectRaw('tours.id, tours.nb as text')->get();
        $mapa = MapaTour::findOrFail($id);
        return view('backend.mapa_tours.edit', compact('tours', 'mapa'));
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
            $r_mapa = $request->mapa;
            $db_mapa = MapaTour::findOrFail($id);
            $db_mapa->latitud=$r_mapa['latitud'];
            $db_mapa->longitud=$r_mapa['longitud'];
            $db_mapa->etiqueta=$r_mapa['etiqueta'];
            $db_mapa->save();

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
            $mapa = MapaTour::findOrFail($id);

            DB::table('language_lines')->whereRaw('CONCAT_WS(".",`group`,`key`)=?', [$mapa->etiqueta_trad])->delete();

            $mapa->delete();

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }
}

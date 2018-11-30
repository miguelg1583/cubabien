<?php

namespace App\Http\Controllers\backend;

use App\ItinerarioTour;
use App\Tour;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItinerarioTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $itinerarios = ItinerarioTour::with('tour')->get();
        $tours = Tour::has('itinerario')->with('itinerario')->get(['id', 'nb']);
        return view('backend.itinerario_tours.index', compact('tours'));
    }

    public function index_datatable()
    {
        $itinerarios = ItinerarioTour::with('tour')->get();
        return view('backend.itinerario_tours.index_datatable', compact('itinerarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $tours = DB::table('tours')->selectRaw('tours.id, tours.nb as text')->get();
//        $tours = Tour::with('itinerario')->get()->filter(function($value, $key){return count($value.itinerario->get())<$value.num_dias;})->get(['id', 'nb AS text']);
        $tours = Tour::all()->filter(function ($item){return $item->cant_itine<$item->num_dias;});
//        dd($tours);
        return view('backend.itinerario_tours.create', compact('tours'));
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
            $r_itine = $request->itinerario_tour;
            $itine = new ItinerarioTour();
            $itine->tour_id = $r_itine['tour_id'];
            $itine->dia = $r_itine['dia'];
            $itine->contenido = $r_itine['contenido']['valor'];
            $itine->save();

            $id_itine = $itine->id;

            $itine->contenido_trad = guarda_trad('itinerario_contenido', $id_itine, $r_itine['contenido']['traduccion']['text']);
            $itine->update();
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
        return response()->json(['mensaje' => 'OK']);
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
        $tours = Tour::all();
        $itinerario = ItinerarioTour::findOrFail($id);
        return view('backend.itinerario_tours.edit', compact('itinerario', 'tours'));
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
            $r_itine = $request->itinerario_tour;
            $db_itine = ItinerarioTour::findOrFail($id);
            $db_itine->dia=$r_itine['dia'];
            $db_itine->contenido=$r_itine['contenido'];
            $db_itine->save();

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
            $itinerario = ItinerarioTour::findOrFail($id);

            DB::table('language_lines')->whereRaw('CONCAT_WS(".",`group`,`key`)=?', [$itinerario->contenido_trad])->delete();

            $itinerario->delete();

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function getDataToModal(Request $request)
    {
        try {
            $rItine = $request->id;
            $rdato = $request->dato;
            $resp = "";
            switch ($rdato) {
                case "contenido":
                    $resp = ItinerarioTour::findOrFail($rItine)->contenido;
                    break;
            }
            return $resp;
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        } catch (\Throwable $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

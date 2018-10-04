<?php

namespace App\Http\Controllers\backend;

use App\ItinerarioTour;
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
        $itinerarios = ItinerarioTour::with('tour')->get();
        return view('backend.itinerario_tours.index', compact('itinerarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

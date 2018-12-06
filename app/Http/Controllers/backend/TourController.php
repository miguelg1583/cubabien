<?php

namespace App\Http\Controllers\backend;

use App\FechaTour;
use App\ItinerarioTour;
use App\MapaTour;
use App\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Date\Date;
use phpDocumentor\Reflection\Types\Integer;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::all();
        return view('backend.tours.index', compact(['tours']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tours.create');
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
            $r_tour = $request->tour;
            $r_itinerario_tour = $request->itinerario_tour;
            $r_fecha_tour = $request->fecha_tour;
            $r_mapa_tour = $request->mapa_tour;


            $tour = new Tour();
            $tour->nb = $r_tour['nb']['valor'];
            $tour->introd = $r_tour['introd']['valor'];
            $tour->num_dias = $r_tour['num_dias'];
            $tour->num_noches = $r_tour['num_noches'];
            $tour->salida_dia_trad = $r_tour['salida_dia'];
            $tour->llegada_dia_trad = $r_tour['llegada_dia'];
            $tour->activo = true;
            $tour->save();

            $id = $tour->id;

            $tour = Tour::findOrFail($id);
            $tour->nb_trad = guarda_trad('tour_nombre', $id, $r_tour['nb']['traduccion']['text']);
            $tour->introd_trad = guarda_trad('tour_introduccion', $id, $r_tour['introd']['traduccion']['text']);
            $tour->save();

            foreach ($r_itinerario_tour as $r_itine) {
                $itinerario = new ItinerarioTour();
                $itinerario->tour_id = $id;
                $itinerario->dia = $r_itine['dia'];
                $itinerario->contenido = $r_itine['contenido']['valor'];
                $itinerario->save();

                $id_itine = $itinerario->id;

                $itinerario = ItinerarioTour::findOrFail($id_itine);
                $itinerario->contenido_trad = guarda_trad('itinerario_contenido', $id_itine, $r_itine['contenido']['traduccion']['text']);
                $itinerario->save();
            }

            foreach ($r_fecha_tour as $r_fecha) {
                $fecha = new FechaTour();
                $fecha->tour_id = $id;
                $fecha->desde = Carbon::createFromFormat('d/m/Y', $r_fecha['desde']);
                $fecha->hasta = Carbon::createFromFormat('d/m/Y', $r_fecha['hasta']);
                $fecha->precio_s_pax = $r_fecha['precio_s_pax'];
                $fecha->precio_d_pax = $r_fecha['precio_d_pax'];
                $fecha->save();
            }

            foreach ($r_mapa_tour as $r_mapa) {
                $mapa = new MapaTour();
                $mapa->tour_id = $id;
                $mapa->latitud = $r_mapa['latitud'];
                $mapa->longitud = $r_mapa['longitud'];
                $mapa->etiqueta = $r_mapa['etiqueta']['valor'];
                $mapa->save();

                $id_mapa = $mapa->id;

                $mapa = MapaTour::findOrFail($id_mapa);
                $mapa->etiqueta_trad = guarda_trad('mapa_etiqueta', $id_mapa, $r_mapa['etiqueta']['traduccion']['text']);
                $mapa->save();
            }

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
        $tour = Tour::findOrFail($id);
        return view('backend.tours.edit', compact('tour'));
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
            $r_tour = $request->tour;

            $tour = Tour::findOrFail($id);
            $tour->nb = $r_tour['nb'];
            $tour->introd = $r_tour['introd'];
            $tour->num_dias = $r_tour['num_dias'];
            $tour->num_noches = $r_tour['num_noches'];
            $tour->salida_dia_trad = $r_tour['salida_dia_trad'];
            $tour->llegada_dia_trad = $r_tour['llegada_dia_trad'];
            $tour->save();

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
            report($e);
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
        //
    }

    public function getDataToModal(Request $request)
    {
        try {
            $rTour = $request->id;
            $rdato = $request->dato;
            $resp = "";
            switch ($rdato) {
                case "introd":
                    $resp = Tour::findOrFail($rTour)->introd;
                    break;
//                case "respuesta":
//                    $resp = PreguntaResp::findOrFail($rTour)->respuesta;
//                    break;
            }
            return $resp;
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        } catch (\Throwable $e) {
            return response()->json(['errors' => $e]);
        }
    }

    public function setActivo(Request $request, $id)
    {
        try {
            $dbTour = Tour::findOrFail($id);
            $dbTour->activo = ($request->valor == "false") ? 0 : 1;
            $dbTour->save();
            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }
}

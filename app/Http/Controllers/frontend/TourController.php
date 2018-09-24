<?php

namespace App\Http\Controllers\frontend;

use App\Tour;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('mapa')->get();
        $marcadores = [];
        foreach ($tours as $tour) {
            foreach ($tour->mapa as $item_mapa) {
                $marcadores[] = [$item_mapa->latitud, $item_mapa->latitud, $item_mapa->etiqueta_trad];
            }
        }
        return view('frontend.tours.index', compact(['tours', 'marcadores']));
    }

    public function show($id)
    {
        try {
            $marcadores = [];
            $tour = Tour::findOrFail($id);
            foreach ($tour->mapa as $item_mapa) {
                $marcadores[] = [$item_mapa->latitud, $item_mapa->latitud, $item_mapa->etiqueta_trad];
            }
            return view('frontend.tours.details', compact(['tour', 'marcadores']));
        } catch (\Exception $e) {
            report($e);
            return abort(404);
        }
    }

    public function getFechasAfterTodayList(Request $request)
    {
        $tour = Tour::findOrFail($request->tour);
        $fechasDesde = $tour->getAllFechaAfterToday();
        try {
            return Datatables::of($fechasDesde)
                ->addColumn('operaciones', function ($row) {
                    return '<button class="btn button btn-red radius5 btn-sm" data-id="' . $row->id . '">' . __('button.add-cart') . '</button>';
                })
                ->rawColumns(['operaciones'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

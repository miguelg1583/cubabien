<?php

namespace App\Http\Controllers\frontend;

use App\ImagenPub;
use App\Tour;
use DataTables;
//use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Routing\Middleware\ThrottleRequestsWithRedis;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('mapa')->whereActivo(1)->get();
        $marcadores = [];
        foreach ($tours as $tour) {
            foreach ($tour->mapa as $item_mapa) {
                $marcadores[] = [$item_mapa->latitud, $item_mapa->longitud, __($item_mapa->etiqueta_trad)];
            }
        }
        $img_tour = ImagenPub::whereLugar('Tour')->get(['imagen']);
        $imgs = [];
        foreach ($img_tour as $img) {
            $imgs[] = getImageThumbnail($img->imagen, 700, 780, 'fit');
        }
        return view('frontend.tours.index', compact(['tours', 'marcadores', 'imgs']));
    }

    public function show($id)
    {
        try {
            $marcadores = [];
            $tour = Tour::findOrFail($id);
            foreach ($tour->mapa as $item_mapa) {
                $marcadores[] = [$item_mapa->latitud, $item_mapa->longitud, __($item_mapa->etiqueta_trad)];
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
                    return '<a href="javascript:;" class="btn button btn-red radius5 btn-sm cd-add-to-cart" data-id="' . $row->id . '" data-price="' . $row->precio_d_pax . '">' . __('button.add-cart') . '</a>';
                })
                ->editColumn('precio_s_pax', function ($row) {
                    return '$ ' . number_format((float)$row->precio_s_pax, 2, '.', '');
                })
                ->editColumn('precio_d_pax', function ($row) {
                    return '$ ' . number_format((float)$row->precio_d_pax, 2, '.', '');
                })
                ->rawColumns(['operaciones'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

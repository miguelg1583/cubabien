<?php

namespace App\Http\Controllers\backend;

use App\FechaTour;
use Carbon\Carbon;
use DataTables;
use Date;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarioTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $calendarios = FechaTour::with('tour')->get();
        return view('backend.calendario_tours.index');
    }

    public function index_datatable()
    {
//        $calendarios = FechaTour::with('tour')->get();
        return view('backend.calendario_tours.index_datatable');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tours = DB::table('tours')->selectRaw('tours.id, tours.nb as text')->get();
        return view('backend.calendario_tours.create', compact('tours'));
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
            $r_fecha = $request->fecha;
            $fecha = new FechaTour();
            $fecha->tour_id = $r_fecha['tour_id'];
            $fecha->desde = Carbon::createFromFormat('d/m/Y', $r_fecha['desde'])->format('Y-m-d');
            $fecha->hasta = Carbon::createFromFormat('d/m/Y', $r_fecha['hasta'])->format('Y-m-d');
            $fecha->precio_s_pax = $r_fecha['precio_s_pax'];
            $fecha->precio_d_pax = $r_fecha['precio_d_pax'];
            $fecha->save();
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
        $tours = DB::table('tours')->selectRaw('tours.id, tours.nb as text')->get();
        $calendario = FechaTour::findOrFail($id,['id','tour_id','desde','hasta','precio_s_pax','precio_d_pax']);
//        dd($calendario);
        return view('backend.calendario_tours.edit', compact('tours', 'calendario'));
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
            $r_fecha = $request->fecha;
            $fecha = FechaTour::findOrFail($id);
            $fecha->tour_id = $r_fecha['tour_id'];
            $fecha->desde = Carbon::createFromFormat('d/m/Y', $r_fecha['desde'])->format('Y-m-d');
            $fecha->hasta = Carbon::createFromFormat('d/m/Y', $r_fecha['hasta'])->format('Y-m-d');
            $fecha->precio_s_pax = $r_fecha['precio_s_pax'];
            $fecha->precio_d_pax = $r_fecha['precio_d_pax'];
            $fecha->save();

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
        try {
            $calendario = FechaTour::findOrFail($id);

            $calendario->delete();

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function getList()
    {
        $calendarios = FechaTour::with('tour');
        try {
            return Datatables::of($calendarios)
                ->editColumn('desde', function ($row) {
                    Date::setLocale('es');
                    return Date::createFromFormat('Y-m-d', $row->desde)->format('D, d/m/y');
                })
                ->editColumn('hasta', function ($row) {
                    Date::setLocale('es');
                    return Date::createFromFormat('Y-m-d', $row->hasta)->format('D, d/m/y');
                })
                ->editColumn('precio_s_pax', function ($row) {
                    return '$ ' . number_format((float)$row->precio_s_pax, 2, '.', '');
                })
                ->editColumn('precio_d_pax', function ($row) {
                    return '$ ' . number_format((float)$row->precio_d_pax, 2, '.', '');
                })
                ->editColumn('created_at', function ($row) {
                    Date::setLocale('es');
                    return Date::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('D, d/m/y h:i a');
                })
                ->editColumn('updated_at', function ($row) {
                    Date::setLocale('es');
                    return Date::createFromFormat('Y-m-d H:i:s', $row->updated_at)->format('D, d/m/y h:i a');
                })
                ->addColumn('operaciones', function ($row) {
                    return
                        '<a href="' . url('/admin/calendario-tour') . '/' . $row->id . '/edit'.'" class="btn btn-round btn-info" ' .
                        'data-id="' . $row->id . '" ' . '>' .
                        '<span class="glyphicon glyphicon-edit"></span>' .
                        '</a>' .
                        '<button class="btn btn-round btn-danger delete-modal" ' .
                        'data-id="' . $row->id . '" ' .
                        'data-toggle="modal" data-target="#deleteModal">' .
                        '<span class="glyphicon glyphicon-trash"></span>' .
                        '</button>';
                })
                ->rawColumns(['operaciones'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }

    public function getCalendar(Request $request)
    {
        $intervalo = [$request->start, $request->end];

        $fecha_tours = FechaTour::with('tour')->whereBetween('desde', $intervalo)->orWhereBetween('hasta', $intervalo)->get();

        $arrEvent = [];

        foreach ($fecha_tours as $fecha_tour) {

            $arrEvent[] = ['id' => $fecha_tour->id, 'title' => $fecha_tour->tour->nb . ' | Precio S: $' . $fecha_tour->precio_s_pax . ' | Precio D: $' . $fecha_tour->precio_d_pax, 'start' => $fecha_tour->desde, 'end' => Carbon::createFromFormat('Y-m-d', $fecha_tour->hasta)->addDay()->format('Y-m-d')];
        }

        return response()->json($arrEvent);
    }

    public function showCalendar(Request $request)
    {
        try {
            $calendario = FechaTour::with('tour')->findOrFail($request->id);
            Date::setLocale('es');
            $calendario->desde = Date::createFromFormat('Y-m-d', $calendario->desde)->format('D, d/m/y');
            $calendario->hasta = Date::createFromFormat('Y-m-d', $calendario->hasta)->format('D, d/m/y');
            return view('backend.calendario_tours.partial.show_modal_content', compact('calendario'))->render();
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        } catch (\Throwable $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

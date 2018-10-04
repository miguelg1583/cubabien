<?php

namespace App\Http\Controllers\backend;

use App\FechaTour;
use Carbon\Carbon;
use DataTables;
use Date;
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
        $calendarios = FechaTour::with('tour')->get();
        return view('backend.calendario_tours.index', compact('calendarios'));
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
                    return Date::createFromFormat('Y-m-d',$row->desde)->format('D, d/m/y');
                })
                ->editColumn('hasta', function ($row) {
                    Date::setLocale('es');
                    return Date::createFromFormat('Y-m-d',$row->hasta)->format('D, d/m/y');
                })
                ->editColumn('precio_s_pax', function ($row){
                    return '$ '.number_format((float)$row->precio_s_pax, 2, '.', '');
                })
                ->editColumn('precio_d_pax', function ($row){
                    return '$ '.number_format((float)$row->precio_d_pax, 2, '.', '');
                })
                ->editColumn('created_at', function ($row) {
                    Date::setLocale('es');
                    return Date::createFromFormat('Y-m-d H:i:s',$row->created_at)->format('D, d/m/y h:i a');
                })
                ->editColumn('updated_at', function ($row) {
                    Date::setLocale('es');
                    return Date::createFromFormat('Y-m-d H:i:s',$row->updated_at)->format('D, d/m/y h:i a');
                })
                ->addColumn('operaciones', function ($row) {
                    return
                        '<a href="' . url('/admin/calendario-tour') . '/' . $row->id . '" class="btn btn-round btn-info" ' .
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
}

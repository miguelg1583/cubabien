<?php

namespace App\Http\Controllers\backend;

use App\Agency;
use App\AgencyRequest;
use App\AgencyUser;
use DataTables;
use Date;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class AgentController extends Controller
{
    public function index_request()
    {
        return view('backend.travel_agent.index_request');
    }

    public function get_request_list()
    {
//        $requests = AgencyRequest::query()->orderByDesc('created_at')->get(['id','name','autorizada','address','email','d_b_num','phone_num','year_business','travel_permit_filename','iata_num','owner_name','title','anual_sales_volume','created_at']);
        $requests = AgencyRequest::query()->orderByDesc('created_at');
        try {
            return Datatables::of($requests)
                ->editColumn('travel_permit_filename', function (AgencyRequest $req) {
                    $req->travel_permit_file ? $res = '<a href="' . route('travel-agent.get_permit_file', [$req->id]) . '" class="show_modal_table" target="_blank">' . $req->travel_permit_filename . '</a>' : $res = '';
                    return $res;
                })
                ->editColumn('email', function ($row) {
                    return '<a href="mailto:' . $row->email . '" class="show_modal_table">' . $row->email . '</a>';
                })
                ->editColumn('created_at', function ($row) {
                    Date::setLocale('es');
                    return $row->created_at->format('D, d/m/y h:i a');
                })
                ->editColumn('autorizada', function ($row) {
                    if ($row->autorizada) {
                        return '<span class="badge bg-green">SI</span>';
                    }
                    return '<span class="badge bg-red">NO</span>';
                })
                ->addColumn('operaciones', function ($row) {
                    if ($row->autorizada) {
//                        return '<a href="#"  data-id="' . $row->id . '" class="btn btn-round btn-danger desactivar"><span class="glyphicon glyphicon-remove"></span></a>';
                        return '';
                    }
                    return '<a href="#" data-id="' . $row->id . '" class="btn btn-round btn-success activar"><span class="glyphicon glyphicon-ok"></span></a>';
                })
                ->rawColumns(['email', 'travel_permit_filename', 'autorizada', 'operaciones'])
                ->make(true);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function download_travel_permit($id)
    {
        try {
            $agency_request = AgencyRequest::findOrFail($id);
            $response = Response::make($agency_request->travel_permit_file, 200);
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('Content-Type', 'application/octet-stream');
            $response->header('Content-Disposition', 'attachment;  filename="' . $agency_request->travel_permit_filename . '"');
            return $response;
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function preloadAgencia(Request $request)
    {
        try {
            $rAgencia = AgencyRequest::findOrFail($request->id);
            $pass = str_random(8);
            return response()->json(['name' => $rAgencia->name, 'email' => $rAgencia->email, 'username' => $rAgencia->owner_name, 'password' => $pass]);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function autorizaAgencia(Request $request)
    {
        try {
            $r_agencia = $request->agencia;
            $agencia_db_request = AgencyRequest::findOrFail($r_agencia['id']);

            $agencia = new Agency();
            $agencia->name = $agencia_db_request->name;
            $agencia->address = $agencia_db_request->address;
            $agencia->email = $agencia_db_request->email;
            $agencia->d_b_num = $agencia_db_request->d_b_num;
            $agencia->phone_num = $agencia_db_request->phone_num;
            $agencia->year_business = $agencia_db_request->year_business;
            $agencia->travel_permit_filename = $agencia_db_request->travel_permit_filename;
            $agencia->travel_permit_file = $agencia_db_request->travel_permit_file;
            $agencia->iata_num = $agencia_db_request->iata_num;
            $agencia->owner_name = $agencia_db_request->owner_name;
            $agencia->title = $agencia_db_request->title;
            $agencia->anual_sales_volume = $agencia_db_request->anual_sales_volume;
            $agencia->save();

            AgencyUser::create([
                'name' => $r_agencia['username'],
                'email' => $r_agencia['email'],
                'agency_id' => $agencia->id,
                'password' => Hash::make($r_agencia['password']),
            ]);

            $agencia_db_request->autorizada = true;
            $agencia_db_request->update();

            \Log::info('Agencia ? creada, con usuario: ?, email: ?, y password inicial: ?', [$agencia->name, $r_agencia['username'], $r_agencia['email'], $r_agencia['password']]);

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function index_agencia()
    {
        return view('backend.travel_agent.index_agencia');
    }

    public function getAgencia(Request $request)
    {
        try {
            $rAgencia = Agency::findOrFail($request->id);
            return response()->json(['name' => $rAgencia->name, 'email' => $rAgencia->email, 'porciento_descuento' => $rAgencia->porciento_descuento]);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function cambiaPorciento(Request $request)
    {
        try {
            $r_agencia = $request->agencia;
            $rAgencia = Agency::findOrFail($r_agencia['id']);
            $rAgencia->porciento_descuento = $r_agencia['porciento_descuento'];
            $rAgencia->update();
            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function get_agency_list()
    {
        $agencias = Agency::query();
        try {
            return Datatables::of($agencias)
                ->editColumn('email', function ($row) {
                    return '<a href="mailto:' . $row->email . '" class="show_modal_table">' . $row->email . '</a>';
                })
                ->editColumn('porciento_descuento', function ($row) {
                    return $row->porciento_descuento . ' %';
                })
                ->addColumn('operaciones', function ($row) {
                    return '<a href="#" data-id="' . $row->id . '" class="btn btn-round btn-success cambia-porciento"><span class="glyphicon glyphicon-usd"></span></a>';
                })
                ->rawColumns(['email', 'operaciones'])
                ->make(true);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function index_usuario()
    {
        return view('backend.travel_agent.index_usuario');
    }

    public function get_user_list()
    {
        $usuarios = AgencyUser::with('agency');
        try {
            return Datatables::of($usuarios)
                ->editColumn('email', function ($row) {
                    return '<a href="mailto:' . $row->email . '" class="show_modal_table">' . $row->email . '</a>';
                })
                ->editColumn('activo', function ($row) {
                    if ($row->activo) {
                        return '<input type="checkbox" class="btog-activo" id="check' . $row->id . '" data-id="' . $row->id . '" checked>';
                    }
                    return '<input type="checkbox" class="btog-activo" id="check' . $row->id . '" data-id="' . $row->id . '">';
                })
                ->addColumn('operaciones', function ($row) {
                    return '<a href="#" data-id="' . $row->id . '" class="btn btn-round btn-success cambia-password"><span class="glyphicon glyphicon-refresh"></span></a>';
                })
                ->rawColumns(['email', 'activo', 'operaciones'])
                ->make(true);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function cambiaActivo($id)
    {
        try {
            $dbAgencyUser = AgencyUser::findOrFail($id);
            $dbAgencyUser->activo = ($dbAgencyUser->activo == 1) ? 0 : 1;
            $dbAgencyUser->save();
            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function cambiaPassword(Request $request)
    {
        try {
            $rUsuario = $request->usuario;

            $dbUsuario = AgencyUser::findOrFail($rUsuario['id']);
            $dbUsuario->password = Hash::make($rUsuario['password']);
            $dbUsuario->update();

            \Log::info('Usuario: ?, cambiada la contraseña a: ?', [$dbUsuario->name, $rUsuario['password']]);

            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function getUser(Request $request)
    {
        try {
            $dbUsuario = AgencyUser::findOrFail($request->id);
            return response()->json(['name' => $dbUsuario->name, 'email' => $dbUsuario->email]);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function index_createUser()
    {
        $agencias = Agency::all(['id', 'name AS text']);
        return view('backend.travel_agent.create_usuario', compact('agencias'));
    }

    public function createUser(Request $request)
    {
        try {
            $r_usuario = $request->usuario;

            AgencyUser::create([
                'name' => $r_usuario['nombre'],
                'email' => $r_usuario['email'],
                'agency_id' => (int)$r_usuario['agencia'],
                'password' => Hash::make($r_usuario['password']),
            ]);

            \Log::info('Usuario: ?, creado la contraseña es: ?', [$r_usuario['nombre'], $r_usuario['password'], $r_usuario['email'], $r_usuario['agencia']]);

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }
}

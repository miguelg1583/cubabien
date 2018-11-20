<?php

namespace App\Http\Controllers\backend;

use App\Contact;
use Date;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function getList()
    {
        $contactos = Contact::all()->sortByDesc('created_at');
//        $contactos = Contact::query();
        try {
            return Datatables::of($contactos)
                ->editColumn('email', function ($row){
                    return '<a href="mailto:'.$row->email.'" class="show_modal_table">'.$row->email.'</a>';
                })
                ->editColumn('created_at', function ($row){
                    Date::setLocale('es');
                    return $row->created_at->format('D, d/m/y h:i a');
                })
                ->editColumn('atendido', function ($row){
                    if($row->atendido){
                        return '<input type="checkbox" class="btog-activo" id="check'.$row->id.'" data-id="'.$row->id.'" checked>';
                    }
                    return '<input type="checkbox" class="btog-activo" id="check'.$row->id.'" data-id="'.$row->id.'">';
                })
                ->rawColumns(['email','mensaje','atendido'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }

    public function setAtendido(Request $request, $id)
    {
        try {
            $dbContact = Contact::findOrFail($id);
            $dbContact->atendido ? $dbContact->atendido = false : $dbContact->atendido = true;
            $dbContact->update();
            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function index()
    {
        return view('backend.contactos.index');
    }
}

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
        $contactos = Contact::all();
        try {
            return Datatables::of($contactos)
                ->editColumn('email', function ($row){
                    return '<a href="mailto:'.$row->email.'" class="show_modal_table">'.$row->email.'</a>';
                })
                ->editColumn('created_at', function ($row){
                    Date::setLocale('es');
                    return $row->created_at->format('D, d/m/y h:i a');
                })
                ->rawColumns(['email'])
                ->make(true);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }

    public function index()
    {
        return view('backend.contactos.index');
    }
}

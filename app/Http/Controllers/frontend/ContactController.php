<?php

namespace App\Http\Controllers\frontend;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact_us');
    }

    public function store(Request $request)
    {
        try {
            $rcontacto = $request->contacto;

            $dbcontacto= new Contact();
            $dbcontacto->nombre= $rcontacto['nombre'];
            $dbcontacto->email= $rcontacto['email'];
            $dbcontacto->mensaje= $rcontacto['mensaje'];
            $dbcontacto->save();

            return response()->json(['mensaje' => 'OK']);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

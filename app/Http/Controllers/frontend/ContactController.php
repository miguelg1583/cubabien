<?php

namespace App\Http\Controllers\frontend;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

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

            $regla = ['captcha' => 'required|captcha'];
            $validator = Validator::make($rcontacto, $regla);
            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            } else {
            $dbcontacto= new Contact();
            $dbcontacto->nombre= $rcontacto['nombre'];
            $dbcontacto->email= $rcontacto['email'];
            $dbcontacto->mensaje= clean($rcontacto['mensaje']);
            $dbcontacto->save();

            return response()->json(['mensaje' => 'OK']);}
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

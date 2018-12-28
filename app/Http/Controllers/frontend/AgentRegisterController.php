<?php

namespace App\Http\Controllers\frontend;

use App\AgencyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AgentRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('frontend.travel_agent.register');
    }

    public function store(Request $request)
    {
        try {
            $r_agencia = $request->agencia;
            $r_agencia['travel_permit_file'] = getDocument($r_agencia['travel_permit_file']);

            $regla = ['captcha' => 'required|captcha'];
            $validator = Validator::make($r_agencia, $regla);
            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            } else {
                $db_agencia_reg= new AgencyRequest();
                $db_agencia_reg->name= $r_agencia['name'];
                $db_agencia_reg->address= $r_agencia['address'];
                $db_agencia_reg->email= $r_agencia['email'];
                $db_agencia_reg->d_b_num= $r_agencia['d_b_num'];
                $db_agencia_reg->phone_num= $r_agencia['phone_num'];
                $db_agencia_reg->year_business= $r_agencia['year_business'];
                $db_agencia_reg->travel_permit_filename= $r_agencia['travel_permit_filename'];
                $db_agencia_reg->travel_permit_file= $r_agencia['travel_permit_file'];
                $db_agencia_reg->iata_num= $r_agencia['iata_num'];
                $db_agencia_reg->owner_name= $r_agencia['owner_name'];
                $db_agencia_reg->title= $r_agencia['title'];
                $db_agencia_reg->anual_sales_volume= $r_agencia['anual_sales_volume'];

                $db_agencia_reg->save();

                return response()->json(['mensaje' => 'OK']);}
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

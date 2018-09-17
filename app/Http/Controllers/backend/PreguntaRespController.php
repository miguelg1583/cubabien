<?php

namespace App\Http\Controllers\backend;

use App\PreguntaResp;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreguntaRespController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas_resps = PreguntaResp::with('categoriaFaq')->get();
        return view('backend.pregunta_resp.index', compact('preguntas_resps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = DB::table('categoria_faqs')->selectRaw('categoria_faqs.id, categoria_faqs.nb as text')->get();
        return view('backend.pregunta_resp.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $r_preg_resp = $request->pregunta_resp;

            $preg_resp = new PreguntaResp();
            $preg_resp->categoria_faq_id = $r_preg_resp['categoria_faq_id'];
            $preg_resp->pregunta = $r_preg_resp['pregunta']['valor'];
            $preg_resp->respuesta = $r_preg_resp['respuesta']['valor'];
            $preg_resp->save();

            $id = $preg_resp->id;

            $preg_resp = PreguntaResp::findOrFail($id);
            $preg_resp->pregunta_trad = guarda_trad('pregunta', $id, $r_preg_resp['pregunta']['traduccion']['text']);
            $preg_resp->respuesta_trad = guarda_trad('respuesta', $id, $r_preg_resp['respuesta']['traduccion']['text']);
            $preg_resp->save();

            return response()->json(['mensaje' => 'OK']);


        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = DB::table('categoria_faqs')->selectRaw('categoria_faqs.id, categoria_faqs.nb as text')->get();
        $pregunta_resp = PreguntaResp::findOrFail($id);
        return view('backend.pregunta_resp.edit', compact(['pregunta_resp','categorias']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $r_pregunta_resp = $request->pregunta_resp;
            $db_pregunta_resp = PreguntaResp::findOrFail($id);
            $db_pregunta_resp->pregunta=$r_pregunta_resp['pregunta'];
            $db_pregunta_resp->respuesta=$r_pregunta_resp['respuesta'];
            $db_pregunta_resp->save();

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $preguntaResp = PreguntaResp::findOrFail($id);

            DB::table('language_lines')->whereRaw('CONCAT_WS(".",`group`,`key`)=?', [$preguntaResp->pregunta_trad])->delete();
            DB::table('language_lines')->whereRaw('CONCAT_WS(".",`group`,`key`)=?', [$preguntaResp->respuesta_trad])->delete();

            $preguntaResp->delete();

            return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function getDataToModal(Request $request)
    {
        try {
            $rPreg = $request->id;
            $rdato = $request->dato;
            $resp = "";
            switch ($rdato){
                case "pregunta":
                    $resp = PreguntaResp::findOrFail($rPreg)->pregunta;
                    break;
                case "respuesta":
                    $resp = PreguntaResp::findOrFail($rPreg)->respuesta;
                    break;
            }
            return $resp;
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        } catch (\Throwable $e) {
            return response()->json(['errors' => $e]);
        }
    }
}

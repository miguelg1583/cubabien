<?php

namespace App\Http\Controllers\backend;

use DataTables;
use DB;
use Debugbar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Spatie\TranslationLoader\LanguageLine;
use Validator;

class TraduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $idiomas = DB::table('idiomas')->get(['sigla', 'nombre']);
        $traducciones = LanguageLine::all();
        return view('backend.traducciones.index', compact(['traducciones']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $idiomas = DB::table('idiomas')->get(['sigla', 'nombre']);
        return view('backend.traducciones.create');
    }

    public function getGrupos(Request $request)
    {
        $param = $request->get('q', '');
        $grupos = DB::table('language_lines')->selectRaw('DISTINCT(`group`)')->whereRaw("`group` like '%" . $param . "%'")->get()->pluck('group');
        return response()->json(["query" => "Unit", "suggestions" => $grupos]);
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
            $traduccion = $request->traduccion;

            $regla = ['key' => 'unique:language_lines,key,null,null,group,' . $traduccion['group']];
            $validator = Validator::make($traduccion, $regla);
            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            } else {
                $arrKey = [];
                $arrVal = [];

                foreach ($traduccion['text'] as $rtext) {
                    $arrKey[] = $rtext['lengua'];
                    $arrVal[] = $rtext['text'];
                }

                LanguageLine::create([
                    'group' => $traduccion['group'],
                    'key' => $traduccion['key'],
                    'text' => array_combine($arrKey, $arrVal),
                ]);

                return response()->json(['mensaje' => 'OK']);
            }


        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
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
//        $idiomas = DB::table('idiomas')->get(['sigla', 'nombre']);
        $trad = LanguageLine::findOrFail($id);
        $text_json = [];
        foreach ($trad->text as $key => $value) {
            $text_json[] = ['lengua' => $key, 'text' => $value];
        }
        $trad->text = $text_json;
//        lengua: item.sigla,
//                            text: ''

        return view('backend.traducciones.edit', compact(['idiomas', 'trad']));
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
            $traduccion = $request->traduccion;
            $regla = ['key' => 'unique:language_lines,key,' . $traduccion['id'] . ',id,group,' . $traduccion['group']];
            $validator = Validator::make($traduccion, $regla);
            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            } else {
                $arrKey = [];
                $arrVal = [];
                foreach ($traduccion['text'] as $rtext) {
                    $arrKey[] = $rtext['lengua'];
                    $arrVal[] = $rtext['text'];
                }

                $dbTrad = LanguageLine::findOrFail($id);
                $dbTrad->group = $traduccion['group'];
                $dbTrad->key = $traduccion['key'];
                $dbTrad->text = array_combine($arrKey, $arrVal);
                $dbTrad->save();

                return response()->json(['mensaje' => 'OK']);
            }

        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $trad = LanguageLine::findOrFail($id)->delete();
            if ($trad) return response()->json(['mensaje' => 'OK']);

        } catch (\Exception $e) {
//            Debugbar::error($e);
            return response()->json(['errors' => $e]);
        }
    }

    public function getTradToModal(Request $request)
    {
        try {
            $rTrad = $request->trad;
            $trad = DB::table('language_lines')->whereRaw('CONCAT_WS(".",`group`,`key`)=?', [$rTrad])->first();
            return view('backend.traducciones.partial.show_modal_content', compact('trad'))->render();
        } catch (\Exception $e) {
            return response()->json(['errors' => $e]);
        } catch (\Throwable $e) {
            return response()->json(['errors' => $e]);
        }


    }
}

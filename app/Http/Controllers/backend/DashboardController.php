<?php

namespace App\Http\Controllers\backend;

use App\Contact;
use App\Tour;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $annos = DB::table('contacts')->selectRaw("YEAR(contacts.created_at) AS 'anno'")->groupBy(['anno'])->pluck('anno');
        return view('backend.dashboard', compact('annos'));
    }

    public function getDataContact(Request $request)
    {
        $anno = $request->anno;
        $c = DB::table('contacts')
            ->selectRaw("Count(contacts.id) AS 'id', MONTH(contacts.created_at) AS 'mes'")
            ->whereRaw("YEAR(contacts.created_at)=?",$anno)
            ->groupBy(['mes'])
            ->get();

        $arr = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach ($c as $item) {
            $arr[($item->mes)-1] = $item->id;
        }

        return $arr;
    }

    public function getDataTourVisitas()
    {
        $tours_db = Tour::all('nb', 'visitas');
        $tours = $tours_db->pluck('nb');
        $visitas = $tours_db->pluck('visitas');

        return response()->json(['tours'=>$tours, 'visitas'=>$visitas]);
    }
}

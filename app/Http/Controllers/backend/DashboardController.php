<?php

namespace App\Http\Controllers\backend;

use App\Contact;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }

    public function getDataContact()
    {
        $c = DB::table('contacts')
            ->selectRaw("Count(contacts.id) AS 'id', MONTH(contacts.created_at) AS 'mes'")
            ->whereRaw("YEAR(contacts.created_at)=?",[Date('Y')])
            ->groupBy(['mes'])
            ->get();

        $arr = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach ($c as $item) {
            $arr[($item->mes)-1] = $item->id;
        }

        return $arr;
    }
}

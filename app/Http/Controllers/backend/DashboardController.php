<?php

namespace App\Http\Controllers\backend;

use App\Contact;
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
        $c = Contact::all()->whereBetween('created_at', ['', ''])->get();
    }
}

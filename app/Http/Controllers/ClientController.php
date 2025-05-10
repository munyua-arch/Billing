<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index()
    {

        return view('clients.index');
    }

    public function ppoe()
    {

        return view('clients.ppoe');
    }
}

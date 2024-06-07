<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuiRoController extends Controller
{
    public function index()
    {
        return view('guest-acc.risk.risk-index');
    }
}

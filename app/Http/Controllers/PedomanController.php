<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedomanController extends Controller
{
    public function index()
    {
        return view('pedoman.index');
    }
}
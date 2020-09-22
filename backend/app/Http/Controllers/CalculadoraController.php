<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class calculadoraController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function __invoke(Request $request)
    // {
    //     //
    // }

    public function bootstrap()
    {
        return view('calculadora.bootstrap');
    }

    public function materialize()
    {
        return view('calculadora.materialize');
    }
}
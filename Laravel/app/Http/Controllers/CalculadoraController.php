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

    public function calculadoraGET()
    {
        return view('calculadora.calculadora-simples');
    }

    public function calculadoraPOST(Request $request)
    {
        return view('calculadora.calculadora-simples', $request->all());
    }


}
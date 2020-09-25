<?php

namespace App\Services;

use App\Repositories\CalculadoraRepository;

class CalculadoraService
{

    public function calculadoraGET(){
        return view('calculadora.calculadora-simples');
    }

    public function calculadoraPOST($formulario){
        dd($formulario);
        return view('calculadora.calculadora-simples', $formulario);
    }


}

?>
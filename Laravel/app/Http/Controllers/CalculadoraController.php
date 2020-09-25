<?php

namespace App\Http\Controllers;

use App\Services\CalculadoraService;
use Illuminate\Http\Request;

class calculadoraController extends Controller {

    public function __construct(CalculadoraService $service)
    {
        $this->service = $service;
    }

    public function calculadoraGET() {
        return $this->service->calculadoraGET();
    }

    public function calculadoraPOST(Request $request) {
        return $this->service->calculadoraPOST($request->all());
    }

}
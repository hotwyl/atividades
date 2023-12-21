<?php

interface CalculadoraInterface {
    public function calcularValorHora(float $salarioMensal): float;
    public function calcularValorProjeto(float $horasEstimadas): float;
}

abstract class CalculadoraBase implements CalculadoraInterface {
    protected float $valorHora;

    public function __construct(float $valorHora) {
        $this->valorHora = $valorHora;
    }

    public function calcularValorHora(float $salarioMensal): float {
        return $salarioMensal / (4 * 5 * 8); // considerando 4 semanas e 5 dias úteis por semana
    }

    public function calcularValorProjeto(float $horasEstimadas): float {
        return $this->valorHora * $horasEstimadas;
    }

    public function getValorHora(): float {
        return $this->valorHora;
    }

    public function setValorHora(float $valorHora): void {
        $this->valorHora = $valorHora;
    }
}

class CalculadoraFreelance extends CalculadoraBase {
    public function __construct(float $valorHora) {
        parent::__construct($valorHora);
    }
}

// Defina a classe para a API Freelancer
class FreelancerAPI {
    private CalculadoraInterface $calculadora;

    public function __construct(CalculadoraInterface $calculadora) {
        $this->calculadora = $calculadora;
    }

    public function setValorHora(float $valorHora): void {
        $this->calculadora->setValorHora($valorHora);
    }

    public function calcularValorHora(float $salarioMensal): float {
        return $this->calculadora->calcularValorHora($salarioMensal);
    }

    public function calcularValorProjeto(float $horasEstimadas): float {
        return $this->calculadora->calcularValorProjeto($horasEstimadas);
    }
}

// Criar uma instância da calculadora e da API Freelancer
$calculadora = new CalculadoraFreelance(50.0);
$freelancerAPI = new FreelancerAPI($calculadora);

// Configurar um novo valor de hora
$freelancerAPI->setValorHora(60.0);

// Calcular o valor do projeto
$horasEstimadas = 20;
$valorProjeto = $freelancerAPI->calcularValorProjeto($horasEstimadas);

// Obter e imprimir o valor do projeto
echo "Valor do projeto para $horasEstimadas horas estimadas: $valorProjeto";

<?php



$qtd = 1; //quantidade de apostas a serem geradas
$aposta = [];

// Exemplo de uso para Lotomania
$numerosDisponiveisLotomania = range(1, 100); // Números de 1 a 100 na Lotomania
$quantidadeNumerosLotomania = 50; // Quantidade de números na Lotomania

$geradorLotomania = new GeradorApostasLoteria($numerosDisponiveisLotomania, $quantidadeNumerosLotomania);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['lotomania'][] = $geradorLotomania->gerarAposta();
}

// Exemplo de uso para Lotofácil
$numerosDisponiveisLotofacil = range(1, 25); // Números de 1 a 25 na Lotofácil
$quantidadeNumerosLotofacil = 15; // Quantidade de números na Lotofácil

$geradorLotofacil = new GeradorApostasLoteria($numerosDisponiveisLotofacil, $quantidadeNumerosLotofacil);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['lotofacil'][] = $geradorLotofacil->gerarAposta();
}

// Exemplo de uso para Mega-Sena
$numerosDisponiveisMegaSena = range(1, 60); // Números de 1 a 60 na Mega-Sena
$quantidadeNumerosMegaSena = 6; // Quantidade de números na Mega-Sena

$geradorMegaSena = new GeradorApostasLoteria($numerosDisponiveisMegaSena, $quantidadeNumerosMegaSena);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['megaSena'][] = $geradorMegaSena->gerarAposta();
}

// Exemplo de uso para Quina
$numerosDisponiveisQuina = range(1, 80); // Números de 1 a 80 na Quina
$quantidadeNumerosQuina = 5; // Quantidade de números na Quina

$geradorQuina = new GeradorApostasLoteria($numerosDisponiveisQuina, $quantidadeNumerosQuina);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['quina'][] = $geradorQuina->gerarAposta();
}

// Exemplo de uso para Dupla Sena
$numerosDisponiveisDuplaSena = range(1, 50); // Números de 1 a 50 na Dupla Sena
$quantidadeNumerosDuplaSena = 6; // Quantidade de números na Dupla Sena

$geradorDuplaSena = new GeradorApostasLoteria($numerosDisponiveisDuplaSena, $quantidadeNumerosDuplaSena);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['duplaSena'][] = $geradorDuplaSena->gerarAposta();
}

// Exemplo de uso para Dia de Sorte
$numerosDisponiveisDiaDeSorte = range(1, 31); // Números de 1 a 31 no Dia de Sorte
$quantidadeNumerosDiaDeSorte = 7; // Quantidade de números no Dia de Sorte

$geradorDiaDeSorte = new GeradorApostasLoteria($numerosDisponiveisDiaDeSorte, $quantidadeNumerosDiaDeSorte);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['diaDeSorte'][] = $geradorDiaDeSorte->gerarAposta();
}

// Exemplo de uso para Super Sete
$numerosDisponiveisSuperSete = range(1, 10); // Números de 1 a 10 no Super Sete
$quantidadeNumerosSuperSete = 7; // Quantidade de números no Super Sete

$geradorSuperSete = new GeradorApostasLoteria($numerosDisponiveisSuperSete, $quantidadeNumerosSuperSete);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['superSete'][] = $geradorSuperSete->gerarAposta();
}

// Exemplo de uso para +Milionária
$numerosDisponiveisMilionaria = range(1, 80); // Números de 1 a 80 no +Milionária
$quantidadeNumerosMilionaria = 7; // Quantidade de números no +Milionária

$geradorMilionaria = new GeradorApostasLoteria($numerosDisponiveisMilionaria, $quantidadeNumerosMilionaria);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['milionaria'][] = $geradorMilionaria->gerarAposta();
}

// Exemplo de uso para Timemania
$numerosDisponiveisTimemania = range(1, 80); // Números de 1 a 80 na Timemania
$quantidadeNumerosTimemania = 10; // Quantidade de números na Timemania

$geradorTimemania = new GeradorApostasLoteria($numerosDisponiveisTimemania, $quantidadeNumerosTimemania);

for ($i = 1; $i <= $qtd; $i++) {
    $aposta['timemania'][] = $geradorTimemania->gerarAposta();
}

print_r(json_encode($aposta));
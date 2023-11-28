<?php

function classificarArea($respostas) {

    $pontuacaoTotal = 0;

    foreach ($respostas as $resposta) {
        $pontuacaoTotal += $resposta;
    }

    $pontuacoes = [
        'ciencias_exploracao' => 0,
        'artes_criatividade' => 0,
        'empreendedorismo_negocios' => 0,
        'saude_bem_estar' => 0,
    ];

    foreach ($respostas as $resposta) {
        switch ($resposta) {
            case '1':
                $pontuacoes['ciencias_exploracao']++;
                break;
            case '2':
                $pontuacoes['artes_criatividade']++;
                break;
            case '3':
                $pontuacoes['empreendedorismo_negocios']++;
                break;
            case '4':
                $pontuacoes['saude_bem_estar']++;
                break;
        }
    }

    $porcentagem['ciencias_exploracao'] = (($pontuacoes['ciencias_exploracao']*1) / $pontuacaoTotal) * 100;
    $porcentagem['artes_criatividade'] = (($pontuacoes['artes_criatividade']*2)  / $pontuacaoTotal) * 100;
    $porcentagem['empreendedorismo_negocios'] = (($pontuacoes['empreendedorismo_negocios']*3)  / $pontuacaoTotal) * 100;
    $porcentagem['saude_bem_estar'] = (($pontuacoes['saude_bem_estar']*4)  / $pontuacaoTotal) * 100;

    return $porcentagem;
}

// Exemplo de respostas, onde cada valor representa a pontuação da resposta na respectiva pergunta
$respostas = [3, 4, 2, 1, 3, 4, 2, 1, 4, 3, 2, 1, 4, 2, 3, 1, 4, 3, 2, 1, 4, 3, 2, 1, 4];

$result = classificarArea($respostas);

print_r($result); exit;

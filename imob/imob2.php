<?php

// Função para calcular o valor do imóvel
function calcularValorImovel($tipoImovel, $custoConstrucao, $valorTerreno, $valorAdicional) {
    // Lógica para diferentes tipos de imóveis
    switch ($tipoImovel) {
        case "Residencial":
            return $custoConstrucao + $valorTerreno + $valorAdicional;
        case "Comercial":
            return $custoConstrucao + $valorTerreno + $valorAdicional;
        case "Industrial":
            return $custoConstrucao + $valorTerreno + $valorAdicional;
        case "Terrenos":
            return $valorTerreno + $valorAdicional;
        case "Rural":
            return $valorTerreno + $valorAdicional;
        case "Imóveis de Temporada":
            return $custoConstrucao + $valorTerreno + $valorAdicional;
        case "Imóveis Compartilhados":
            return $custoConstrucao + $valorTerreno + $valorAdicional;
        case "Imóveis Comerciais e Residenciais Mistas":
            return $custoConstrucao + $valorTerreno + $valorAdicional;
        default:
            return 0;
    }
}

// Função para calcular o valor de aluguel
function calcularValorAluguel($tipoImovel, $valorImovel, $taxaAdministracao, $outrasTaxas, $taxaSeguro, $taxasAdicionais) {
    $valorImovelCalculado = 100000;
    // Lógica para diferentes tipos de imóveis
    switch ($tipoImovel) {
        case "Residencial":
            $valorImovelCalculado = $valorImovel * (1 + $taxaAdministracao) + $outrasTaxas;
        case "Comercial":
            $valorImovelCalculado = $valorImovel * (1 + $taxaAdministracao) + $outrasTaxas;
        case "Industrial":
            $valorImovelCalculado = $valorImovel * (1 + $taxaAdministracao) + $outrasTaxas;
        case "Terrenos":
            $valorImovelCalculado = $outrasTaxas;
        case "Rural":
            $valorImovelCalculado = $outrasTaxas;
        case "Imóveis de Temporada":
            $valorImovelCalculado = $valorImovel * (1 + $taxaAdministracao) + $outrasTaxas;
        case "Imóveis Compartilhados":
            $valorImovelCalculado = $valorImovel * (1 + $taxaAdministracao) + $outrasTaxas;
        case "Imóveis Comerciais e Residenciais Mistas":
            $valorImovelCalculado = $valorImovel * (1 + $taxaAdministracao) + $outrasTaxas;
    }

    $base = $valorImovelCalculado*0.07;
    return ($taxaAdministracao * $base) + $taxaSeguro + $taxasAdicionais;
}

// Função para calcular o valor de venda
function calcularValorVenda($tipoImovel, $valorImovel, $taxaCorretagem, $custoDocumentacao) {
    // Lógica para diferentes tipos de imóveis
    switch ($tipoImovel) {
        case "Residencial":
            return $valorImovel * (1 + $taxaCorretagem) + $custoDocumentacao;
        case "Comercial":
            return $valorImovel * (1 + $taxaCorretagem) + $custoDocumentacao;
        case "Industrial":
            return $valorImovel * (1 + $taxaCorretagem) + $custoDocumentacao;
        case "Terrenos":
            return $valorImovel + $custoDocumentacao;
        case "Rural":
            return $valorImovel + $custoDocumentacao;
        case "Imóveis de Temporada":
            return $valorImovel * (1 + $taxaCorretagem) + $custoDocumentacao;
        case "Imóveis Compartilhados":
            return $valorImovel * (1 + $taxaCorretagem) + $custoDocumentacao;
        case "Imóveis Comerciais e Residenciais Mistas":
            return $valorImovel * (1 + $taxaCorretagem) + $custoDocumentacao;
        default:
            return 0;
    }
}

// Exemplo de uso das funções
$tipoImovelExemplo = "Residencial"; // Defina o tipo de imóvel conforme necessário
$custoConstrucaoExemplo = 80000;
$valorTerrenoExemplo = 50000;
$valorAdicionalExemplo = 10000;

$taxaAdministracaoExemplo = 0.1;
$outrasTaxasExemplo = 5000;
$taxaCorretagemExemplo = 0.05;
$custoDocumentacaoExemplo = 3000;
$taxaSeguro = 100; // Valor do seguro
$taxasAdicionais = 50; // Outras taxas

$valorImovelCalculado = calcularValorImovel($tipoImovelExemplo, $custoConstrucaoExemplo, $valorTerrenoExemplo, $valorAdicionalExemplo);
$valorVendaCalculado = calcularValorVenda($tipoImovelExemplo, $valorImovelCalculado, $taxaCorretagemExemplo, $custoDocumentacaoExemplo);
$valorAluguelCalculado = calcularValorAluguel($tipoImovelExemplo, $valorImovelCalculado, $taxaAdministracaoExemplo, $outrasTaxasExemplo, $taxaSeguro, $taxasAdicionais);

echo "Valor do Imóvel: R$ " . number_format($valorImovelCalculado, 2, ',', '.') . "\n";
echo "Valor de Venda: R$ " . number_format($valorVendaCalculado, 2, ',', '.') . "\n";
echo "Valor mensal do aluguel: R$ " . number_format($valorAluguelCalculado, 2, ',', '.') . "\n";

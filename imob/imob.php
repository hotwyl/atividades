<?php
// Parâmetros iniciais
$valorImovel = 100000; // Valor do imóvel
$entrada = 20000; // Valor da entrada
$rendaFamiliar = 4000; // Renda familiar para o exemplo
$taxaJuros = 7; // Taxa de juros para o exemplo
$numParcelas = 360; // Número de parcelas para o exemplo


$subsidioCalculado = calcularSubsidioMCMV($rendaFamiliar, $valorImovel);
$documentacaoRegistro = calcularCustoDocumentacaoRegistro($valorImovel);
$seguroObras = calcularCustoSeguroObras($valorImovel);
$valorFinanciado = $valorImovel - $entrada - $subsidioCalculado;
$prestacaoPrice = calcularPrestacoesPrice($valorFinanciado, $taxaJuros, $numParcelas);
$prestacoesSAC = calcularPrestacoesSAC($valorFinanciado, $taxaJuros, $numParcelas);
$totalCustos = $documentacaoRegistro + $seguroObras;
$valorFinal = $valorFinanciado + $totalCustos;


// Saída
echo "O subsídio do governo para uma renda familiar de R$ " . number_format($rendaFamiliar, 2, ',', '.') . " em um imóvel de R$ " . number_format($valorImovel, 2, ',', '.') . " pode ser de R$ " . number_format($subsidioCalculado, 2, ',', '.') . "\n";
echo "O custo total de documentação e registro para um imóvel de R$ " . number_format($valorImovel, 2, ',', '.') . " é de R$ " . number_format($documentacaoRegistro, 2, ',', '.') . "\n";
echo "O custo total do seguro de obras para um imóvel de R$ " . number_format($valorImovel, 2, ',', '.') . " é de R$ " . number_format($seguroObras, 2, ',', '.') . "\n";
echo "Valor Financiado: R$ " . number_format($valorFinanciado, 2, ',', '.') . "\n";
echo "Custos Totais: R$ " . number_format($totalCustos, 2, ',', '.') . "\n";
echo "Valor Final: R$ " . number_format($valorFinal, 2, ',', '.') . "\n";

echo "Prestação (Tabela Price): R$ " . number_format($prestacaoPrice, 2, ',', '.') . "\n";
echo "Prestações (Tabela SAC): \n";

foreach ($prestacoesSAC as $index => $prestacao) {
    echo "Mês " . ($index + 1) . ": R$ " . number_format($prestacao, 2, ',', '.') . "\n";
}


//
 function calcularCustoDocumentacaoRegistro($valorImovel) {
    // Taxa fixa para custos de documentação e registro
    $taxaFixa = 1000; // Custo fixo de documentação e registro

    // Cálculo do custo baseado em uma porcentagem do valor do imóvel
    $porcentagemValorImovel = 0.015; // Porcentagem do valor do imóvel para cálculo de custo

    $custo = $taxaFixa + ($valorImovel * $porcentagemValorImovel);
    return $custo;
}

//
function calcularCustoSeguroObras($valorImovel) {
    // Taxa fixa para o custo do seguro de obras
    $taxaFixa = 500; // Custo fixo do seguro de obras

    // Cálculo do custo baseado em uma porcentagem do valor do imóvel
    $porcentagemValorImovel = 0.005; // Porcentagem do valor do imóvel para cálculo de custo

    $custo = $taxaFixa + ($valorImovel * $porcentagemValorImovel);
    return $custo;
}

// Função para calcular prestações de acordo com a Tabela Price
function calcularPrestacoesPrice($valorFinanciado, $taxaJuros, $numParcelas) {
    $taxa = $taxaJuros / 100;
    $prestacao = $valorFinanciado * ($taxa / (1 - pow(1 + $taxa, -$numParcelas)));
    return $prestacao;
}

// Função para calcular prestações de acordo com a Tabela SAC (Sistema de Amortização Constante)
function calcularPrestacoesSAC($valorFinanciado, $taxaJuros, $numParcelas) {
    $taxa = $taxaJuros / 100;
    $amortizacao = $valorFinanciado / $numParcelas;
    $prestacoes = array();
    $saldoDevedor = $valorFinanciado;
    for ($i = 1; $i <= $numParcelas; $i++) {
        $juros = $saldoDevedor * $taxa;
        $prestacao = $amortizacao + $juros;
        $saldoDevedor -= $amortizacao;
        $prestacoes[] = $prestacao;
    }
    return $prestacoes;
}

function calcularSubsidioMCMV($rendaFamiliar, $valorImovel) {

    // Critérios para o benefício do governo
    $limiteRenda = 5000; // Limite de renda familiar para ser elegível para o benefício
    
   
    // Verifica se a renda familiar está abaixo do limite para o benefício
    if ($rendaFamiliar <= $limiteRenda) {
    	if ($rendaFamiliar <= 3000) {
	        // Faixa 1: 
	        $percentualBeneficio = 0.11;
	    } 
	    
	    if ($rendaFamiliar <= 6000) {
	        // Faixa 2: 
	        $percentualBeneficio = 0.23;
	    } 
    
        // Calcula o valor do benefício com base no percentual do valor do imóvel
        return floatval($valorImovel) * floatval($percentualBeneficio);

    } else {
        return 0; // Retorna 0 se a renda familiar exceder o limite
    }
}
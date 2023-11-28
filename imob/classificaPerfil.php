<?php

function classificarPerfilComprador($rendaPerCapita, $quantidadeDependentes) {
    $faixaValorImovel = "";
    $tipoFinanciamento = "";
    $valorMedioImovel = 0;
    $faixaValoresImovel = "";

    if ($rendaPerCapita > 10000) {
        $faixaValorImovel = "Alta";
        $tipoFinanciamento = "Convencional | Tradicional | Hipotecários ";
        $valorMedioImovel = 500000;
        $faixaValoresImovel = "500.000 - 1.000.000";
    } elseif ($rendaPerCapita > 5000 && $rendaPerCapita < 10000) {
        $faixaValorImovel = "Média";
        $tipoFinanciamento = "Misto | Empréstimos Hipotecários Convencionais";
        $valorMedioImovel = 300000;
        $faixaValoresImovel = "200.000 - 500.000";
    } elseif ($rendaPerCapita > 1000) {
        $faixaValorImovel = "Baixa";
        $tipoFinanciamento = "Programas governamentais e Sociais | Empréstimos FHA (Federal Housing Administration) | Empréstimos para Habitação de Organizações Sem Fins Lucrativos";
        $valorMedioImovel = 150000;
        $faixaValoresImovel = "100.000 - 200.000";
    } else {
        $faixaValorImovel = "Baixa";
        $tipoFinanciamento = "Programas governamentais e Sociais Habitacional | Financiamento coletivo ou crowdfunding imobiliário";
        $valorMedioImovel = '?';
        $faixaValoresImovel = "?";
    }

    $perfil = array(
        "faixa_valor_imovel" => $faixaValorImovel,
        "tipo_financiamento" => $tipoFinanciamento,
        "valor_medio_imovel" => $valorMedioImovel,
        "faixa_valores_imovel" => $faixaValoresImovel,
        "quantidade_dependentes" => $quantidadeDependentes
    );

    // Lógica adicional para classificar com base em outros critérios como idade, grau de instrução e patrimônio

    return $perfil;
}

function calcRendaPerCapita($rendaExemplo, $quantidadeDependentesExemplo) {
    return $rendaExemplo / ($quantidadeDependentesExemplo + 1);
}

// Exemplo de uso da função
$rendaExemplo = 10000; // Renda familiar
$quantidadeDependentesExemplo = 2; // Quantidade de dependentes
$idadeExemplo = 35; // Idade do comprador
$grauInstrucaoExemplo = "Superior Completo"; // Grau de instrução do comprador
$patrimonioExemplo = 150000; // Patrimônio do comprador

$rendaPerCapitaExemplo = calcRendaPerCapita($rendaExemplo, $quantidadeDependentesExemplo);// Renda per capita

$perfilComprador = classificarPerfilComprador($rendaPerCapitaExemplo, $quantidadeDependentesExemplo, $idadeExemplo, $grauInstrucaoExemplo, $patrimonioExemplo);

echo "Perfil do comprador: \n";
echo "Faixa de valor do imóvel: " . $perfilComprador['faixa_valor_imovel'] . "\n";
echo "Tipo de financiamento: " . $perfilComprador['tipo_financiamento'] . "\n";
echo "Valor médio do imóvel: R$ " . number_format($perfilComprador['valor_medio_imovel'], 2, ',', '.') . "\n";
echo "Faixa de valores dos imóveis: " . $perfilComprador['faixa_valores_imovel'] . "\n";
echo "Quantidade de dependentes: " . $perfilComprador['quantidade_dependentes'] . "\n";
?>

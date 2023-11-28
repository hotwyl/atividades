<?php

/*
* Função para calcular o Índice de Eficiência (Expense Ratio):
* Índice de Eficiência (Expense Ratio):
* -Fórmula: Expense Ratio = Despesas Totais / Valor Total do Fundo
* -Essa fórmula calcula a proporção das despesas totais em relação ao valor total do fundo imobiliário. Ajuda a avaliar a eficiência na gestão dos recursos.
*/
function calcularExpenseRatio($despesasTotais, $valorTotalFundo) {
    // Fórmula: Expense Ratio = Despesas Totais / Valor Total do Fundo
    $expenseRatio = $despesasTotais / $valorTotalFundo;
    return $expenseRatio;
}

/*
* Função para calcular a Taxa de Vacância:
* Taxa de Vacância:
* -Fórmula: Taxa de Vacância = (Área Vaga / Área Total) * 100
* -Essa fórmula calcula a proporção da área vaga em relação à área total do fundo imobiliário. Ajuda a avaliar a ocupação dos imóveis e a estabilidade dos rendimentos.
*/
function calcularTaxaVacancia($areaVaga, $areaTotal) {
    // Fórmula: Taxa de Vacância = (Área Vaga / Área Total) * 100
    $taxaVacancia = ($areaVaga / $areaTotal) * 100;
    return $taxaVacancia;
}

/*
* Função para calcular o Índice de Liquidez:
* Índice de Liquidez:
* -Fórmula: Índice de Liquidez = Ativos Líquidos / Passivos
* -Essa fórmula calcula a capacidade do fundo imobiliário de honrar suas obrigações financeiras. Quanto maior o índice de liquidez, maior a capacidade de pagamento.
*/
function calcularIndiceLiquidez($ativosLiquidos, $passivos, $precoAtual, $liquidezDiaria) {
    // Fórmula: Índice de Liquidez = Ativos Líquidos / Passivos
    $indiceLiquidez = $ativosLiquidos / $passivos;
    $valorLiquidez = $precoAtual * $liquidezDiaria;
    return $indiceLiquidez;
}

/*
* Função para calcular a Taxa de Retorno Total:
* Taxa de Retorno Total:
* -Fórmula: Taxa de Retorno Total = (Valor de Venda + Dividendos Recebidos - Investimento Inicial) / Investimento Inicial
* -Essa fórmula calcula a taxa de retorno total de um fundo imobiliário, levando em consideração o valor de venda dos ativos, os dividendos recebidos e o investimento inicial.
*/
function calcularTaxaRetornoTotal($valorVenda, $dividendosRecebidos, $investimentoInicial) {
    // Fórmula: Taxa de Retorno Total = (Valor de Venda + Dividendos Recebidos - Investimento Inicial) / Investimento Inicial
    $taxaRetornoTotal = ($valorVenda + $dividendosRecebidos - $investimentoInicial) / $investimentoInicial;
    return $taxaRetornoTotal;
}


function calcularMultiplicacao($investimento, $retornoAnual) {
    // Fórmula de multiplicação: Multiplicação = Investimento * Retorno Anual
    $multiplicacao = $investimento * $retornoAnual;
    
    return $multiplicacao;
}

/*
* Índice de Sharpe:
*/
function calcularIndiceSharpe($retornoFundo, $retornoLivreRisco, $volatilidade) {
    // Fórmula: Índice de Sharpe = (Retorno do Fundo - Retorno Livre de Risco) / Volatilidade
    $indiceSharpe = ($retornoFundo - $retornoLivreRisco) / $volatilidade;
    return $indiceSharpe;
}
/*
* Índice de Treynor:
*/
function calcularIndiceTreynor($retornoFundo, $retornoLivreRisco, $beta) {
    // Fórmula: Índice de Treynor = (Retorno do Fundo - Retorno Livre de Risco) / Beta
    $indiceTreynor = ($retornoFundo - $retornoLivreRisco) / $beta;
    return $indiceTreynor;
}

/*
* Índice de Sortino:
*/
function calcularIndiceSortino($retornoFundo, $retornoLivreRisco, $volatilidadeNegativa) {
    // Fórmula: Índice de Sortino = (Retorno do Fundo - Retorno Livre de Risco) / Volatilidade Negativa
    $indiceSortino = ($retornoFundo - $retornoLivreRisco) / $volatilidadeNegativa;
    return $indiceSortino;
}

/*
* Índice de Informação:
*/
function calcularIndiceInformacao($retornoFundo, $retornoIndice) {
    // Fórmula: Índice de Informação = Retorno do Fundo - Retorno do Índice
    $indiceInformacao = $retornoFundo - $retornoIndice;
    return $indiceInformacao;
}

/*
* Índice de Beta:
*/
function calcularBeta($retornoFundo, $retornoMercado, $volatilidadeMercado) {
    // Fórmula: Beta = Covariância(Fundo, Mercado) / Variância(Mercado)
    $covariancia = calcularCovariancia($retornoFundo, $retornoMercado);
    $variancia = calcularVariancia($retornoMercado);
    $beta = $covariancia / $variancia;
    return $beta;
}

/*
* Função para calcular a Covariância:
*/
function calcularCovariancia($retornoFundo, $retornoMercado) {
    $n = count($retornoFundo);

    // Média do Retorno do Fundo
    $mediaFundo = array_sum($retornoFundo) / $n;

    // Média do Retorno do Mercado
    $mediaMercado = array_sum($retornoMercado) / $n;

    // Soma das diferenças ao quadrado
    $somaDiferencasQuadrado = 0;
    for ($i = 0; $i < $n; $i++) {
        $diferencaFundo = $retornoFundo[$i] - $mediaFundo;
        $diferencaMercado = $retornoMercado[$i] - $mediaMercado;
        $somaDiferencasQuadrado += $diferencaFundo * $diferencaMercado;
    }

    // Covariância
    $covariancia = $somaDiferencasQuadrado / ($n - 1);
    return $covariancia;
}

/*
* Função para calcular a Variância:
*/
function calcularVariancia($retorno) {
    $n = count($retorno);

    // Média do Retorno
    $media = array_sum($retorno) / $n;

    // Soma das diferenças ao quadrado
    $somaDiferencasQuadrado = 0;
    for ($i = 0; $i < $n; $i++) {
        $diferenca = $retorno[$i] - $media;
        $somaDiferencasQuadrado += $diferenca * $diferenca;
    }

    // Variância
    $variancia = $somaDiferencasQuadrado / ($n - 1);
    return $variancia;
}

/**
 * 
 */
function custoMercado($precoAtual, $vpa) {

    $classificação = ($precoAtual > $vpa) ? "Maior" : "Menor";
    $valor = $precoAtual > $vpa;
}

/**
 * 
 */
function cota_mult($precoAtual, $dividendo) {
    $qtd = ($precoAtual/$dividendo)+1;
    $vlr = $precoAtual*$qtd;
}

/**
 * 
 */
function cota_viver($rendimentoMensalPretendido, $dividendo, $precoAtual) {
    $qtd = ($rendimentoMensalPretendido/$dividendo)+1;
    $vlr = $qtd*$precoAtual;
}

/*
* Índice de Modigliani:
*/
function calcularIndiceModigliani($retornoFundo, $retornoBenchmark, $retornoLivreRisco) {
    // Fórmula: Índice de Modigliani = Retorno do Fundo - Retorno Livre de Risco + (Retorno do Benchmark - Retorno Livre de Risco)
    $indiceModigliani = $retornoFundo - $retornoLivreRisco + ($retornoBenchmark - $retornoLivreRisco);
    return $indiceModigliani;
}

/*
* Índice de Jensen:
*/
function calcularIndiceJensen($retornoFundo, $retornoBenchmark, $retornoLivreRisco, $beta) {
    // Fórmula: Índice de Jensen = Retorno do Fundo - Retorno Livre de Risco - Beta * (Retorno do Benchmark - Retorno Livre de Risco)
    $indiceJensen = $retornoFundo - $retornoLivreRisco - $beta * ($retornoBenchmark - $retornoLivreRisco);
    return $indiceJensen;
}

/*
* Índice de Capture Ratio:
*/
function calcularCaptureRatio($retornoFundo, $retornoBenchmark, $positivo = true) {
    // Fórmula: Capture Ratio = (Retorno do Fundo / Retorno do Benchmark) * 100
    if ($positivo) {
        $retornoFundoPositivo = array_filter($retornoFundo, function ($valor) {
            return $valor > 0;
        });
        $retornoBenchmarkPositivo = array_filter($retornoBenchmark, function ($valor) {
            return $valor > 0;
        });
        $captureRatio = (count($retornoFundoPositivo) / count($retornoBenchmarkPositivo)) * 100;
    } else {
        $retornoFundoNegativo = array_filter($retornoFundo, function ($valor) {
            return $valor < 0;
        });
        $retornoBenchmarkNegativo = array_filter($retornoBenchmark, function ($valor) {
            return $valor < 0;
        });
        $captureRatio = (count($retornoFundoNegativo) / count($retornoBenchmarkNegativo)) * 100;
    }
    return $captureRatio;
}

/*
* Índice de Máximo Retorno/Perda (Ulcer Index):
*/
function calcularUlcerIndex($retornoFundo) {
    // Fórmula: Ulcer Index = SQRT(Soma dos Quadrados das Retrações / Número de Períodos)
    $retracoes = [];
    $maiorValor = $retornoFundo[0];
    for ($i = 1; $i < count($retornoFundo); $i++) {
        if ($retornoFundo[$i] > $maiorValor) {
            $maiorValor = $retornoFundo[$i];
        } else {
            $retracao = ($maiorValor - $retornoFundo[$i]) / $maiorValor;
            $retracoes[] = $retracao * $retracao;
        }
    }
    $ulcerIndex = sqrt(array_sum($retracoes) / count($retracoes));
    return $ulcerIndex;
}

/*
* Índice de Risco-Valor:
*/
function calcularIndiceRiscoValor($retornoFundo, $retornoBenchmark) {
    // Fórmula: Índice de Risco-Valor = (Retorno do Fundo - Retorno do Benchmark) / Risco do Fundo
    $riscoFundo = calcularDesvioPadrao($retornoFundo);
    $indiceRiscoValor = ($retornoFundo - $retornoBenchmark) / $riscoFundo;
    return $indiceRiscoValor;
}

/*
* Índice de Calmar:
*/
function calcularIndiceCalmar($retornoFundo, $periodo) {
    // Fórmula: Índice de Calmar = Retorno Anualizado do Fundo / Máxima Retração em um Período de Tempo
    $retornoAnualizado = calcularRetornoAnualizado($retornoFundo, $periodo);
    $maximaRetracao = calcularMaximaRetracao($retornoFundo);
    $indiceCalmar = $retornoAnualizado / $maximaRetracao;
    return $indiceCalmar;
}

/*
* Índice de Piotroski:
*/
function calcularIndicePiotroski($pontuacao) {
    // Fórmula: Índice de Piotroski = Soma dos Pontos de Classificação
    $indicePiotroski = array_sum($pontuacao);
    return $indicePiotroski;
}

/*
* Índice de Volatilidade Histórica:
*/
function calcularVolatilidadeHistorica($retornoFundo) {
    // Fórmula: Volatilidade Histórica = Desvio Padrão dos Retornos do Fundo
    $volatilidade = calcularDesvioPadrao($retornoFundo);
    return $volatilidade;
}

/*
* Índice de Downside Risk:
*/
function calcularDownsideRisk($retornoFundo, $benchmark, $limiar) {
    // Fórmula: Downside Risk = Desvio Padrão dos Retornos Negativos do Fundo, abaixo do Limiar
    $retornoNegativo = array();
    for ($i = 0; $i < count($retornoFundo); $i++) {
        if ($retornoFundo[$i] < $benchmark && $retornoFundo[$i] < $limiar) {
            $retornoNegativo[] = $retornoFundo[$i];
        }
    }
    $downsideRisk = calcularDesvioPadrao($retornoNegativo);
    return $downsideRisk;
}

/*
Função para calcular o Desvio Padrão:
*/
function calcularDesvioPadrao($retornoFundo) {
    // Média do Retorno do Fundo
    $media = array_sum($retornoFundo) / count($retornoFundo);

    // Calcula a soma dos quadrados das diferenças em relação à média
    $somaQuadrados = 0;
    foreach ($retornoFundo as $retorno) {
        $diferenca = $retorno - $media;
        $somaQuadrados += pow($diferenca, 2);
    }

    // Calcula a variância
    $variancia = $somaQuadrados / count($retornoFundo);

    // Calcula o desvio padrão
    $desvioPadrao = sqrt($variancia);
    return $desvioPadrao;
}

/*
Função para calcular o Retorno Anualizado:
*/
function calcularRetornoAnualizado($retornoFundo, $periodo) {
    // Fórmula: Retorno Anualizado = ((1 + Retorno Acumulado) ^ (1 / N)) - 1
    $retornoAcumulado = array_product($retornoFundo);
    $retornoAnualizado = pow((1 + $retornoAcumulado), (1 / $periodo)) - 1;
    return $retornoAnualizado;
}

/*
Função para calcular a Máxima Retração:
*/
function calcularMaximaRetracao($retornoFundo) {
    // Encontra a máxima retração no fundo
    $maximaRetracao = 0;
    $picoAnterior = $retornoFundo[0];

    foreach ($retornoFundo as $retorno) {
        if ($retorno > $picoAnterior) {
            $picoAnterior = $retorno;
        } else {
            $retracao = ($picoAnterior - $retorno) / $picoAnterior;
            if ($retracao > $maximaRetracao) {
                $maximaRetracao = $retracao;
            }
        }
    }

    return $maximaRetracao;
}

<?php

function calcularIndiceMusculatura($altura, $peso) {
    // Fórmula para calcular o índice de musculatura
    $indice = $peso / ($altura * $altura);
    return $indice;
}

function calcularPesoIdeal($altura, $genero) {
    // Fórmula de Devine para calcular o peso ideal
    if ($genero === 'masculino') {
        $pesoIdeal = 50 + 2.3 * (($altura * 100) - 152.4);
    } else {
        $pesoIdeal = 45.5 + 2.3 * (($altura * 100) - 152.4);
    }

    return $pesoIdeal;
}

// Índice de Massa Corporal (IMC)
function calcularIMC($altura, $peso) {
    // Verifica se a altura é maior que zero para evitar divisão por zero
    if ($altura > 0) {
        // Fórmula para calcular o IMC
        $imc = $peso / ($altura * $altura);
        return $imc;
    } else {
        return 0; // Retorna 0 se a altura for inválida
    }
}

function calcularBF($peso, $altura, $idade, $sexo) {
    // Fórmula para calcular o BF (fórmula de Jackson & Pollock de 4 dobras cutâneas)
    // Os valores constantes na fórmula podem variar dependendo da equação utilizada
    $dobra1 = 0; // Valor da primeira dobra cutânea
    $dobra2 = 0; // Valor da segunda dobra cutânea
    $dobra3 = 0; // Valor da terceira dobra cutânea
    $dobra4 = 0; // Valor da quarta dobra cutânea

    $somaDobras = $dobra1 + $dobra2 + $dobra3 + $dobra4;
    $densidadeCorporal = 1.10938 - (0.0008267 * $somaDobras) + (0.0000016 * $somaDobras * $somaDobras) - (0.0002574 * $idade);

    if ($sexo === 'masculino') {
        // Fórmula para calcular o BF em homens
        $bf = ((4.95 / $densidadeCorporal) - 4.5) * 100;
    } else {
        // Fórmula para calcular o BF em mulheres
        $bf = ((4.95 / $densidadeCorporal) - 4.5) * 100;
    }

    return $bf;
}

function calcularIndiceGordura($peso, $massaGorda) {
    // Fórmula para calcular o índice de gordura
    $indiceGordura = ($massaGorda / $peso) * 100;
    return $indiceGordura;
}

// Percentual de Gordura Corporal
function calcularPercentualGordura($peso, $altura, $genero) {
    // Código para calcular o percentual de gordura corporal usando a técnica de sua escolha
    // Substitua esta parte com o cálculo real baseado na técnica selecionada
    // Exemplo fictício:
    $percentualGordura = 25.5; // Valor fictício
    return $percentualGordura;
}

// Taxa Metabólica Basal (TMB)
function calcularTMB($peso, $altura, $idade, $genero) {
    // Código para calcular a TMB usando a fórmula adequada baseada no gênero
    // Substitua esta parte com a fórmula real baseada no gênero e nos dados do usuário
    // Exemplo fictício:
    

    // Fórmulas para calcular a TMB baseadas no gênero
    if ($genero === 'masculino') {
        $tmb = 66 + (13.75 * $peso) + (5 * $altura * 100) - (6.75 * $idade);
    } else {
        $tmb = 655 + (9.56 * $peso) + (1.85 * $altura * 100) - (4.68 * $idade);
    }

    return $tmb;
}

function calcularNecessidadeCaloricaDiaria($peso, $altura, $idade, $genero, $nivelAtividade) {
    // Cálculo do metabolismo basal (TMB)
    $tmb = calcularTMB($peso, $altura, $idade, $genero);

    // Fator de atividade para multiplicar o TMB
    $fatorAtividade = 0;
    switch ($nivelAtividade) {
        case 'sedentario':
            $fatorAtividade = 1.2;
            break;
        case 'leve':
            $fatorAtividade = 1.375;
            break;
        case 'moderado':
            $fatorAtividade = 1.55;
            break;
        case 'ativo':
            $fatorAtividade = 1.725;
            break;
        case 'muito-ativo':
            $fatorAtividade = 1.9;
            break;
    }

    // Cálculo da necessidade calórica diária total
    $necessidadeCaloricaDiaria = $tmb * $fatorAtividade;

    return $necessidadeCaloricaDiaria;
}

// Gasto Energético Total (GET)
function calcularGET($tmb, $nivelAtividade) {
    // Fator de atividade para multiplicar a TMB
    $fatorAtividade = 0;
    switch ($nivelAtividade) {
        case 'sedentario':
            $fatorAtividade = 1.2;
            break;
        case 'leve':
            $fatorAtividade = 1.375;
            break;
        case 'moderado':
            $fatorAtividade = 1.55;
            break;
        case 'ativo':
            $fatorAtividade = 1.725;
            break;
        case 'muito-ativo':
            $fatorAtividade = 1.9;
            break;
    }

    // Cálculo do GET
    $get = $tmb * $fatorAtividade;
    return $get;
}

// Frequência Cardíaca de Repouso
function calcularFrequenciaCardiacaRepouso($frequenciaCardiaca) {
    // Código para calcular a frequência cardíaca de repouso
    // Substitua esta parte com o cálculo real baseado nos dados do usuário
    // Exemplo fictício:
    $frequenciaCardiacaRepouso = $frequenciaCardiaca;
    return $frequenciaCardiacaRepouso;
}

// Teste de Flexibilidade
function realizarTesteFlexibilidade($resultadoTeste) {
    // Código para realizar o teste de flexibilidade e retornar o resultado
    // Substitua esta parte com o cálculo real baseado no teste selecionado
    // Exemplo fictício:
    $flexibilidade = 'Bom'; // Valor fictício
    return $flexibilidade;
}

// Teste de Força
function realizarTesteForca($resultadoTeste) {
    // Código para realizar o teste de força e retornar o resultado
    // Substitua esta parte com o cálculo real baseado no teste selecionado
    // Exemplo fictício:
    $forca = 'Alta'; // Valor fictício
    return $forca;
}

// Teste de Resistência Cardiovascular
function realizarTesteResistenciaCardiovascular($distancia, $tempo) {
    // Código para realizar o teste de resistência cardiovascular e retornar o resultado
    // Substitua esta parte com o cálculo real baseado no teste selecionado
    // Exemplo fictício:
    $resultado = 'Bom'; // Valor fictício
    return$resultado;
}

// Distribuição de Macronutrientes
function calcularMacronutrientes($get, $proteinaPercentual, $carboidratoPercentual, $gorduraPercentual) {
    // Cálculo dos macronutrientes com base nas porcentagens fornecidas
    $proteina = $get * ($proteinaPercentual / 100);
    $carboidrato = $get * ($carboidratoPercentual / 100);
    $gordura = $get * ($gorduraPercentual / 100);

    $macronutrientes = [
        'proteina' => $proteina,
        'carboidrato' => $carboidrato,
        'gordura' => $gordura
    ];

    return $macronutrientes;
}

// Avaliação de Ingestão Alimentar
function avaliarIngestaoAlimentar($caloriasConsumidas, $proteinaConsumida, $carboidratoConsumido, $gorduraConsumida, $caloriasRecomendadas, $proteinaRecomendada, $carboidratoRecomendado, $gorduraRecomendada) {
    // Cálculo da diferença entre as calorias consumidas e as calorias recomendadas
    $diferencaCalorias = $caloriasConsumidas - $caloriasRecomendadas;

    // Cálculo da diferença entre os macronutrientes consumidos e os recomendados
    $diferencaProteina = $proteinaConsumida - $proteinaRecomendada;
    $diferencaCarboidrato = $carboidratoConsumido - $carboidratoRecomendado;
    $diferencaGordura = $gorduraConsumida - $gorduraRecomendada;

    $avaliacaoIngestao = [
        'diferencaCalorias' => $diferencaCalorias,
        'diferencaProteina' => $diferencaProteina,
        'diferencaCarboidrato' => $diferencaCarboidrato,
        'diferencaGordura' => $diferencaGordura
    ];

    return $avaliacaoIngestao;
}

// Avaliação de Micronutrientes
function avaliarMicronutrientes($vitaminasConsumidas, $mineraisConsumidos, $recomendacaoVitaminas, $recomendacaoMinerais) {
    // Cálculo da diferença entre as vitaminas e minerais consumidos e os recomendados
    $diferencaVitaminas = [];
    $diferencaMinerais = [];

    foreach ($vitaminasConsumidas as $vitamina => $consumo) {
        $diferencaVitaminas[$vitamina] = $consumo - $recomendacaoVitaminas[$vitamina];
    }

    foreach ($mineraisConsumidos as $mineral => $consumo) {
        $diferencaMinerais[$mineral] = $consumo - $recomendacaoMinerais[$mineral];
    }

    $avaliacaoMicronutrientes = [
        'diferencaVitaminas' => $diferencaVitaminas,
        'diferencaMinerais' => $diferencaMinerais
    ];

    return $avaliacaoMicronutrientes;
}

// Necessidade Hídrica
function calcularNecessidadeHidrica($peso) {
    // Cálculo da necessidade hídrica em ml
    $necessidadeHidrica = $peso * 30;
    return $necessidadeHidrica;
}

// Avaliação de Composição Corporal
function avaliarComposicaoCorporal($peso, $altura, $genero, $dobrasCutaneas, $idade) {
    // Cálculo da composição corporal usando a técnica de dobras cutâneas (fórmulas específicas para cada gênero)
    if ($genero === 'masculino') {
        $densidadeCorporal = 1.10938 - (0.0008267 * array_sum($dobrasCutaneas)) + (0.0000016 * pow(array_sum($dobrasCutaneas), 2)) - (0.0002574 * $idade);
        $massaGorda = ($densidadeCorporal * 4.95 / 100) * $peso;
        $massaMagra = $peso - $massaGorda;
    } else {
        $densidadeCorporal = 1.0994921 - (0.0009929 * array_sum($dobrasCutaneas)) + (0.0000023 * pow(array_sum($dobrasCutaneas), 2)) - (0.0001392 * $idade);
        $massaGorda = ($densidadeCorporal * 4.95 / 100) * $peso;
        $massaMagra = $peso - $massaGorda;
    }

    $composicaoCorporal = [
        'massaGorda' => $massaGorda,
        'massaMagra' => $massaMagra
    ];

    return $composicaoCorporal;
}

function calcularBioimpedancia($altura, $peso, $idade, $genero) {
    if ($genero == 'masculino') {
        $bioimpedancia = (13.7516 * $peso) + (5.0033 * $altura) - (6.7550 * $idade) + 66.473;
    } elseif ($genero == 'feminino') {
        $bioimpedancia = (9.5634 * $peso) + (1.8496 * $altura) - (4.6756 * $idade) + 655.0955;
    } else {
        return "Gênero não reconhecido.";
    }

    return $bioimpedancia;
}

// Exemplo de uso das funções:

$altura = 1.75; // Altura em metros
$peso = 70; // Peso em kg
$genero = 'masculino'; // 'masculino' ou 'feminino'
$idade = 30; // Idade em anos
$frequenciaCardiaca = 70; // Frequência cardíaca em repouso em bpm
$distancia = 2000; // Distância percorrida no teste de resistência cardiovascular em metros
$tempo = 720; // Tempo do teste de resistência cardiovascular em segundos
$nivelAtividade = 'moderado'; // 'sedentario', 'leve', 'moderado', 'ativo' ou 'muito-ativo'
$proteinaPercentual = 25; // Porcentagem de proteína desejada na dieta
$carboidratoPercentual = 50; // Porcentagem de carboidrato desejada na dieta
$gorduraPercentual = 25; // Porcentagem de gordura desejada na dieta
$caloriasConsumidas = 2000; // Calorias consumidas pelo cliente
$proteinaConsumida = 150; // Gramas de proteína consumidas pelo cliente
$carboidratoConsumido = 250; // Gramas de carboidrato consumidas pelo cliente
$gorduraConsumida = 70; // Gramas de gordura consumidas pelo cliente
$vitaminasConsumidas = [/* vitaminas consumidas pelo cliente */];
$mineraisConsumidos = [/* minerais consumidos pelo cliente */];
$dobrasCutaneas = [/* valores das dobras cutâneas medidas */];

$imc = calcularIMC($altura, $peso);
$percentualGordura = calcularPercentualGordura($peso, $altura, $genero);
$tmb = calcularTMB($peso, $altura, $idade, $genero);
$get = calcularGET($tmb, $nivelAtividade);
$frequenciaCardiacaRepouso = calcularFrequenciaCardiacaRepouso($frequenciaCardiaca);
$flexibilidade = realizarTesteFlexibilidade($resultadoTeste);
$forca = realizarTesteForca($resultadoTeste);
$resistenciaCardiovascular = realizarTesteResistenciaCardiovascular($distancia, $tempo);
$macronutrientes = calcularMacronutrientes($get, $proteinaPercentual, $carboidratoPercentual, $gorduraPercentual);
$avaliacaoIngestao = avaliarIngestaoAlimentar($caloriasConsumidas, $proteinaConsumida, $carboidratoConsumido, $gorduraConsumida, $caloriasRecomendadas, $proteinaRecomendada, $carboidratoRecomendado, $gorduraRecomendada);
$avaliacaoMicronutrientes = avaliarMicronutrientes($vitaminasConsumidas, $mineraisConsumidos, $recomendacaoVitaminas, $recomendacaoMinerais);
$necessidadeHidrica = calcularNecessidadeHidrica($peso);
$composicaoCorporal = avaliarComposicaoCorporal($peso, $altura, $genero, $dobrasCutaneas, $idade);
$pesoIdeal = calcularPesoIdeal($altura, $genero);
$necessidadeCaloricaDiaria = calcularNecessidadeCaloricaDiaria($peso, $altura, $idade, $genero, $nivelAtividade);
$bioimpedancia = calcularBioimpedancia($altura, $peso, $idade, $genero);

// Exibir os resultados
echo "O peso ideal para uma altura de " . $altura . " metros e gênero " . $genero . " é " . $pesoIdeal . " kg.<br>";
echo "Índice de Massa Corporal (IMC): " . $imc . "<br>";
echo "Percentual de Gordura Corporal: " . $percentualGordura . "%<br>";
echo "Taxa Metabólica Basal (TMB): " . $tmb . " calorias<br>";
echo "Frequência Cardíaca de Repouso: " . $frequenciaCardiacaRepouso . " bpm<br>";
echo "Teste de Flexibilidade: " . $flexibilidade . "<br>";
echo "Teste de Força: " . $forca . "<br>";
echo "Teste de Resistência Cardiovascular: " . $resistenciaCardiovascular . "<br>";
echo "Gasto Energético Total (GET): " . $get . " calorias<br>";
echo "A necessidade calórica diária total é de " . $necessidadeCaloricaDiaria . " calorias.<br>";
echo "Macronutrientes:<br>";
echo " - Proteína: " . $macronutrientes['proteina'] . " calorias<br>";
echo " - Carboidrato: " . $macronutrientes['carboidrato'] . " calorias<br>";
echo " - Gordura: ". $macronutrientes['gordura'] . " calorias<br>";
echo "Avaliação de Ingestão Alimentar:<br>";
echo " - Diferença de Calorias: " . $avaliacaoIngestao['diferencaCalorias'] . " calorias<br>";
echo " - Diferença de Proteína: " . $avaliacaoIngestao['diferencaProteina'] . " gramas<br>";
echo " - Diferença de Carboidrato: " . $avaliacaoIngestao['diferencaCarboidrato'] . " gramas<br>";
echo " - Diferença de Gordura: " . $avaliacaoIngestao['diferencaGordura'] . " gramas<br>";
echo "Avaliação de Micronutrientes:<br>";
echo " - Diferença de Vitaminas:<br>";
foreach ($avaliacaoMicronutrientes['diferencaVitaminas'] as $vitamina => $diferenca) {
    echo "   - " . $vitamina . ": " . $diferenca . " unidades<br>";
}
echo " - Diferença de Minerais:<br>";
foreach ($avaliacaoMicronutrientes['diferencaMinerais'] as $mineral => $diferenca) {
    echo "   - " . $mineral . ": " . $diferenca . " unidades<br>";
}
echo "Necessidade Hídrica: " . $necessidadeHidrica . " ml<br>";
echo "Avaliação de Composição Corporal:<br>";
echo " - Massa Gorda: " . $composicaoCorporal['massaGorda'] . " kg<br>";
echo " - Massa Magra: " . $composicaoCorporal['massaMagra'] . " kg<br>";
echo "O resultado da bioimpedância é: " . $bioimpedancia;
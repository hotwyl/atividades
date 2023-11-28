<?php

$dados = json_decode(file_get_contents('dadosFundos.json'), true);

$dadosFundos = formatDados($dados['dadosFundos'], $dados['dadosGeral']['qtd_cota_calculo']);

$dadosFundsManual = formatDados($dados['dadosFundsManual'], $dados['dadosGeral']['qtd_cota_calculo']);

$newDados = uniArr($dadosFundos, $dadosFundsManual);

$myFi = montaFi($newDados, $dados['dadosMeusFundos'], $dados['dadosGeral']['qtd_cota_calculo']);

print_r($myFi); exit;


function formatDados($dados, $qtd_cota_calculo){

    $newDados = [];
    foreach ($dados as $key => $value) {
        
        $codigo = (strlen($value['codigo']) > 1) ? trim(strtoupper($value['codigo'])) : '';

        $setor = (strlen($value['setor']) > 1) ? trim(strtoupper($value['setor'])) : '';
        
        $preco_atual = (strlen($value['preco_atual']) > 1) ? trim(floatval($value['preco_atual'])) : '';

        $dividendo = (strlen($value['dividendo']) > 1) ? trim(floatval($value['dividendo'])) : '';

        $liquidez_diaria = (strlen($value['liquidez_diaria']) > 1) ? trim(floatval($value['liquidez_diaria'])) : '';

        $vpa = (strlen($value['vpa']) > 1) ? trim(floatval($value['vpa'])) : '';
  
        $liquidez = (floatval($liquidez_diaria) > 0 && floatval($preco_atual) > 0 ) ? floatval($liquidez_diaria * $preco_atual) : '';

        $custo_mercado = (floatval($preco_atual) > 0 && floatval($vpa) > 0 ) ? ($preco_atual > $vpa) ? "Maior" : "Menor" : '';

        $saldo = (floatval($preco_atual) > 0 && floatval($vpa) > 0 ) ? floatval($preco_atual - $vpa) : ''; 
        
        $qtd_cota_mult = (floatval($preco_atual) > 0 && floatval($dividendo) > 0 ) ? intval(($preco_atual / $dividendo) + 1) : '';

        $vlr_cota_mult = (floatval($preco_atual) > 0 && intval($qtd_cota_mult) > 0 ) ? floatval($preco_atual * $qtd_cota_mult) : '';

        $qtd_cota_viver = (intval($qtd_cota_calculo) > 0 && floatval($dividendo) > 0 ) ? intval((intval($qtd_cota_calculo) / $dividendo) + 1) : '';

        $vlr_cota_viver = (intval($qtd_cota_viver) > 0 && floatval($preco_atual) > 0 ) ? floatval($qtd_cota_viver * $preco_atual) : '';
        
        $newDados[$codigo] = [
            'codigo' => $codigo,
            'setor' => $setor,
            'preco_atual' => $preco_atual,
            'dividendo' => $dividendo,
            'liquidez_diaria' => $liquidez_diaria,
            'vpa' => $vpa,
            'liquidez' => $liquidez,
            'custo_mercado' => $custo_mercado,
            'saldo' => $saldo,
            'qtd_cota_mult' => $qtd_cota_mult,
            'vlr_cota_mult' => $vlr_cota_mult,
            'qtd_cota_viver' => $qtd_cota_viver,
            'vlr_cota_viver' => $vlr_cota_viver
        ];

    }

    return $newDados;
    
}

function uniArr($arr1, $arr2){

    $newArr = [];

    foreach ($arr1 as $key => $value) {
        $newArr[strtoupper($value['codigo'])] = $value;
    }

    foreach ($arr2 as $key => $value) {
        $newArr[strtoupper($value['codigo'])] = $value;
    }

    return $newArr;

}

function montaFi($newDados, $dados, $qtd_cota_calculo){

    $totalQtdCotas = 0;
    $totalRendimentoMensal = 0;
    $totalValorInvestido = 0;
    $totalInvestirX = 0;
    $totalDividendoX = 0;

    foreach ($dados as $keyDados => $valueDados) {
        foreach ($newDados as $key => $value) {
        
            if (strtoupper(trim($valueDados['cod'])) === strtoupper(trim($value['codigo']))){
                $codigo = trim(strtoupper($value['codigo']));
                $setor = trim(strtoupper($value['setor']));
                $preco_atual = floatval(trim($value['preco_atual']));
                $dividendo = floatval(trim($value['dividendo']));
                $vpa = floatval(trim($value['vpa']));
                $liquidez_diaria = floatval(trim($value['liquidez_diaria']));
                $custo_mercado = trim($value['custo_mercado']);
                $saldo = floatval(trim($value['saldo']));
                $qtd_cota_mult = floatval(trim($value['qtd_cota_mult']));
                $vlr_cota_mult = floatval(trim($value['vlr_cota_mult']));
                $qtd_cota_viver = floatval(trim($value['qtd_cota_viver']));
                $vlr_cota_viver = floatval(trim($value['vlr_cota_viver']));
                $qtd = intval(trim($valueDados['qtd']));
                $vlr_investido = floatval($preco_atual) * intval($qtd);
                $vlr_retrorno = floatval($dividendo) * intval($qtd);
                $investir_100 = floatval($preco_atual) * intval($qtd_cota_calculo);
                $dividendo_100 = floatval($dividendo) * intval($qtd_cota_calculo);
                $nm_cota_mult = intval(floatval($preco_atual)/floatval($dividendo) + 1);

                $arr['fundos'][strtoupper($valueDados['cod'])] = [
                    'codigo' => $codigo,
                    'setor' => $setor,
                    'preco_atual' => $preco_atual,
                    'dividendo' => $dividendo,
                    'vpa' => $vpa,
                    'liquidez_diaria' => $liquidez_diaria,
                    'custo_mercado' => $custo_mercado,
                    'saldo' => $saldo,
                    'qtd_cotas_adiquirida' => $qtd,
                    'qtd_cota_mult' => $qtd_cota_mult,
                    'vlr_cota_mult' => $vlr_cota_mult,
                    'qtd_cota_viver' => $qtd_cota_viver,
                    'vlr_cota_viver' => $vlr_cota_viver,
                    'vlr_investido' => $vlr_investido,
                    'vlr_retrorno' => $vlr_retrorno,
                    'investir_100' => $investir_100,
                    'dividendo_100' => $dividendo_100,
                    'nm_cota_mult' => $nm_cota_mult
                ];

                if ($qtd > 0){
                    $totalQtdCotas = $totalQtdCotas + $qtd;
                    $totalRendimentoMensal =  $totalRendimentoMensal + $vlr_retrorno;
                    $totalValorInvestido = $totalValorInvestido + $vlr_investido;
                }

                $investir_100 = floatval(floatval(trim($value['preco_atual'])) * intval($qtd_cota_calculo));
                $dividendo_100 = floatval(floatval(trim($value['dividendo'])) * intval($qtd_cota_calculo));
        
                $totalInvestirX = $totalInvestirX + $investir_100;
                $totalDividendoX = $totalDividendoX + $dividendo_100;

            }
        }
        
    }

    $arr['relatorio'] = [
        'qtd_cota_calculo' => $qtd_cota_calculo,
        'totalQtdCotas' =>  $totalQtdCotas,
        'totalRendimentoMensal' => $totalRendimentoMensal,
        'totalValorInvestido' => $totalValorInvestido,
        'totalInvestirX' => $totalInvestirX,
        'totalDividendoX' => $totalDividendoX

    ];

    return $arr;
}

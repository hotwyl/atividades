<?php

// https://www.mazusoft.com.br/lotofacil/resultados.php
// https://www.mazusoft.com.br/lotomania/resultados.php

set_time_limit(180);

$dados = json_decode(file_get_contents('dadosLoteria.json'), true);

$base_lf = $dados["base_lf"];
$sorteio_lf = $dados["sorteio_lf"];
$aposta_lf = $dados["aposta_lf"];
$base_lm = $dados["base_lm"];
$sorteio_lm = $dados["sorteio_lm"];
$aposta_lm = $dados["aposta_lm"];

switch (trim(addslashes($_GET['oper']))) {
	case 'lf1':
		echo json_encode(busca_dados_lf($sorteio_lf, $aposta_lf));
		break;

	case 'lf2':
		echo json_encode(busca_dados_lf($sorteio_lf, $sorteio_lf));
		break;

	case 'lm1':
		echo json_encode(busca_dados_lm($sorteio_lm, $aposta_lm));
		break;

	case 'lm2':
		echo json_encode(busca_dados_lm($sorteio_lm, $sorteio_lm));
		break;

	default:
		echo json_encode('nenhuma opção válida.');
		break;
}

function busca_dados_lf($sorteios, $apostas){

	$numeros_mais_sorteados = [];
	$result = [];
	$t11 = 0;
	$t12 = 0;
	$t13 = 0;
	$t14 = 0;
	$t15 = 0;
	$ts = 0;
	
	foreach ($apostas as $aposta) {
		$aposta = isset($aposta["bolas_sorteadas"]) ? array($aposta["bolas_sorteadas"]) : $aposta;
		$acertos11 = 0;
		$acertos12 = 0;
		$acertos13 = 0;
		$acertos14 = 0;
		$acertos15 = 0;
		$soma = 0;

		foreach ($sorteios as $sorteio) {

			$bolas_sorteadas = explode(',', $sorteio["bolas_sorteadas"]);

			foreach ($bolas_sorteadas as $bola) {
				if (!array_key_exists($bola, $numeros_mais_sorteados)) {
					$numeros_mais_sorteados[$bola] = 0;
				}
				$numeros_mais_sorteados[$bola]++;
			}

			$comparacao = comparacao($sorteio, $aposta);

			if($comparacao['qtd_acertos'] == 11){
				$acertos11++;
			}

			if($comparacao['qtd_acertos'] == 12){
				$acertos12++;
			}

			if($comparacao['qtd_acertos'] == 13){
				$acertos13++;
			}

			if($comparacao['qtd_acertos'] == 14){
				$acertos14++;
			}

			if($comparacao['qtd_acertos'] == 15){
				$acertos15++;
			}

		}

		arsort($numeros_mais_sorteados);

		$soma = ($acertos11 + $acertos12 + $acertos13 + $acertos14 + $acertos15);
		
		if( $soma > $ts ){
						
			if(isset($result['melhor_jogo_geral'][0]['acertos']['soma']) && $result['melhor_jogo_geral'][0]['acertos']['soma'] < $ts){
				
				$result['melhor_jogo_geral'] = [];
			} 

			$ts = $soma;
			
			$result['melhor_jogo_geral'][] = ['aposta' => $aposta[0], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $soma]];
		}

		if( $acertos11 > $t11 ){

			if(isset($result['melhor_jogo_com_11_acerto'][0]['acertos']['11x']) && $result['melhor_jogo_com_11_acerto'][0]['acertos']['11x'] < $t11){
				
				$result['melhor_jogo_com_11_acerto'] = [];
			} 

			$t11 = $acertos11;
			
			$result['melhor_jogo_com_11_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $soma]];

		}

		if( $acertos12 > $t12 ){

			if(isset($result['melhor_jogo_com_12_acerto'][0]['acertos']['12x']) && $result['melhor_jogo_com_12_acerto'][0]['acertos']['12x'] < $t12){
				
				$result['melhor_jogo_com_12_acerto'] = [];
			} 

			$t12 = $acertos12;
			
			$result['melhor_jogo_com_12_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $soma]];

		}

		if( $acertos13 > $t13 ){

			if(isset($result['melhor_jogo_com_13_acerto'][0]['acertos']['13x']) && $result['melhor_jogo_com_13_acerto'][0]['acertos']['13x'] < $t13){
				
				$result['melhor_jogo_com_13_acerto'] = [];
			} 

			$t13 = $acertos13;
			
			$result['melhor_jogo_com_13_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $soma]];

		}

		if( $acertos14 > $t14 ){

			if(isset($result['melhor_jogo_com_14_acerto'][0]['acertos']['14x']) && $result['melhor_jogo_com_14_acerto'][0]['acertos']['14x'] < $t14){
				
				$result['melhor_jogo_com_14_acerto'] = [];
			} 

			$t14 = $acertos14;
			
			$result['melhor_jogo_com_14_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $soma]];

		}

		if( $acertos15 > $t15 ){

			if(isset($result['melhor_jogo_com_15_acerto'][0]['acertos']['15x']) && $result['melhor_jogo_com_15_acerto'][0]['acertos']['15x'] < $t15){
				
				$result['melhor_jogo_com_15_acerto'] = [];
			} 

			$t15 = $acertos15;
			
			$result['melhor_jogo_com_15_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $soma]];

		}

	}

	$result['numeros_mais_sorteados'] = $numeros_mais_sorteados;

	return $result;

}

function busca_dados_lm($sorteios, $apostas){

	$numeros_mais_sorteados = [];
	$result = [];
	$t0 = 0;
	$t15 = 0;
	$t16 = 0;
	$t17 = 0;
	$t18 = 0;
	$t19 = 0;
	$t20 = 0;
	$ts = 0;
	
	foreach ($apostas as $aposta) {
		$aposta = isset($aposta["bolas_sorteadas"]) ? array($aposta["bolas_sorteadas"]) : $aposta;
		$acertos0 = 0;
		$acertos15 = 0;
		$acertos16 = 0;
		$acertos17 = 0;
		$acertos18 = 0;
		$acertos19 = 0;
		$acertos20 = 0;
		$soma = 0;

		foreach ($sorteios as $sorteio) {

			$bolas_sorteadas = explode(',', $sorteio["bolas_sorteadas"]);

			foreach ($bolas_sorteadas as $bola) {
				if (!array_key_exists($bola, $numeros_mais_sorteados)) {
					$numeros_mais_sorteados[$bola] = 0;
				}
				$numeros_mais_sorteados[$bola]++;
			}

			$comparacao = comparacao($sorteio, $aposta);
			
			if($comparacao['qtd_acertos'] == 0){
				$acertos0++;
			}

			if($comparacao['qtd_acertos'] == 15){
				$acertos15++;
			}

			if($comparacao['qtd_acertos'] == 16){
				$acertos16++;
			}

			if($comparacao['qtd_acertos'] == 17){
				$acertos17++;
			}

			if($comparacao['qtd_acertos'] == 18){
				$acertos18++;
			}

			if($comparacao['qtd_acertos'] == 19){
				$acertos19++;
			}

			if($comparacao['qtd_acertos'] == 20){
				$acertos20++;
			}

		}
		
		arsort($numeros_mais_sorteados);

		$soma = ($acertos0 + $acertos15 + $acertos16 + $acertos17 + $acertos18 + $acertos19 + $acertos20);

		if( $soma > $ts ){

			if(isset($result['melhor_jogo_geral'][0]['acertos']['soma']) && $result['melhor_jogo_geral'][0]['acertos']['soma'] < $ts){
				
				$result['melhor_jogo_geral'] = [];
			} 

			$ts = $soma;

			$result['melhor_jogo_geral'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];
		}

		if( $acertos0 > $t0 ){

			if(isset($result['melhor_jogo_com_0_acerto'][0]['acertos']['0x']) && $result['melhor_jogo_com_0_acerto'][0]['acertos']['0x'] < $t0){
				
				$result['melhor_jogo_com_0_acerto'] = [];
			} 

			$t0 = $acertos0;
			
			$result['melhor_jogo_com_0_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];

		}

		if( $acertos15 > $t15 ){

			if(isset($result['melhor_jogo_com_15_acerto'][0]['acertos']['15x']) && $result['melhor_jogo_com_15_acerto'][0]['acertos']['15x'] < $t15){
				
				$result['melhor_jogo_com_15_acerto'] = [];
			} 

			$t15 = $acertos15;
			
			$result['melhor_jogo_com_15_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];

		}

		if( $acertos16 > $t16 ){

			if(isset($result['melhor_jogo_com_16_acerto'][0]['acertos']['16x']) && $result['melhor_jogo_com_16_acerto'][0]['acertos']['16x'] < $t16){
				
				$result['melhor_jogo_com_16_acerto'] = [];
			} 

			$t16 = $acertos16;
			
			$result['melhor_jogo_com_16_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];

		}

		if( $acertos17 > $t17 ){

			if(isset($result['melhor_jogo_com_17_acerto'][0]['acertos']['17x']) && $result['melhor_jogo_com_17_acerto'][0]['acertos']['17x'] < $t17){
				
				$result['melhor_jogo_com_17_acerto'] = [];
			} 

			$t17 = $acertos17;
			
			$result['melhor_jogo_com_17_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];

		}

		if( $acertos18 > $t18 ){

			if(isset($result['melhor_jogo_com_18_acerto'][0]['acertos']['18x']) && $result['melhor_jogo_com_18_acerto'][0]['acertos']['18x'] < $t18){
				
				$result['melhor_jogo_com_18_acerto'] = [];
			} 

			$t18 = $acertos18;
			
			$result['melhor_jogo_com_18_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];

		}

		if( $acertos19 > $t19 ){

			if(isset($result['melhor_jogo_com_19_acerto'][0]['acertos']['19x']) && $result['melhor_jogo_com_19_acerto'][0]['acertos']['19x'] < $t19){
				
				$result['melhor_jogo_com_19_acerto'] = [];
			} 

			$t19 = $acertos19;
			
			$result['melhor_jogo_com_19_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];

		}

		if( $acertos20 > $t20 ){

			if(isset($result['melhor_jogo_com_20_acerto'][0]['acertos']['20x']) && $result['melhor_jogo_com_20_acerto'][0]['acertos']['20x'] < $t20){
				
				$result['melhor_jogo_com_20_acerto'] = [];
			} 

			$t20 = $acertos20;
			
			$result['melhor_jogo_com_20_acerto'][] = ['aposta' => $aposta[0], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $soma]];

		}

	}

	$result['numeros_mais_sorteados'] = $numeros_mais_sorteados;

	return $result;

}

function comparacao($sorteio, $aposta){
	$sorteio = explode(',', $sorteio["bolas_sorteadas"]);
	$aposta = explode(',', $aposta[0]);
	$qtd_acertos = 0;
	$num_acertos = [];

	for ($y=0; $y < count($sorteio); $y++) { 
		
		for ($z=0; $z < count($aposta); $z++) {

			if($sorteio[$y] == $aposta[$z]){
				array_push($num_acertos, $aposta[$z]);
				$qtd_acertos++;
			}

		}

	}

	return array('qtd_acertos' => $qtd_acertos, 'num_acertos' => $num_acertos);
	
}
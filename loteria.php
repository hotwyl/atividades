<?php
/**
 * https://www.mazusoft.com.br/lotofacil/resultados.php
 * https://www.mazusoft.com.br/lotomania/resultados.php
 */

$dados = json_decode(file_get_contents('dadosLoteria.json'), true);

$base_lf = $dados["base_lf"];
$sorteio_lf = $dados["sorteio_lf"];
$aposta_lf = $dados["aposta_lf"];
$base_lm = $dados["base_lm"];
$sorteio_lm = $dados["sorteio_lm"];
$aposta_lm = $dados["aposta_lm"];

$teste = [
	"loto_facil" => busca_dados_lf($sorteio_lf, $aposta_lf),
	"loto_mania" => busca_dados_lm($sorteio_lm, $aposta_lm),
];

echo json_encode($teste, true);

function busca_dados_lf($sorteios, $apostas){
	
	$result = [];
	
	foreach ($apostas as $aposta) {
		$acertos11 = 0;
		$acertos12 = 0;
		$acertos13 = 0;
		$acertos14 = 0;
		$acertos15 = 0;

		foreach ($sorteios as $sorteio) {

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

		$total = ($acertos11 + $acertos12 + $acertos13 + $acertos14 + $acertos15);

		if( $total > 380){
			$result['soma_total'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $total]];
		}

		if( $acertos11 > 320){
			$result['acerto11'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $total]];
		}

		if( $acertos12 > 68){
			$result['acerto12'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $total]];
		}

		if( $acertos13 > 10){
			$result['acerto13'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $total]];
		}

		if( $acertos14 > 3){
			$result['acerto14'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $total]];
		}

		if( $acertos15 > 1){
			$result['acerto15'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['11x' => $acertos11, '12x' => $acertos12, '13x' => $acertos13, '14x' => $acertos14, '15x' => $acertos15, 'soma' => $total]];
		}

	}

	return $result;

}

function busca_dados_lm($sorteios, $apostas){

	$result = [];
	
	foreach ($apostas as $aposta) {
		$acertos0 = 0;
		$acertos15 = 0;
		$acertos16 = 0;
		$acertos17 = 0;
		$acertos18 = 0;
		$acertos19 = 0;
		$acertos20 = 0;

		foreach ($sorteios as $sorteio) {

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
		
		$total = ($acertos0 + $acertos15 + $acertos16 + $acertos17 + $acertos18 + $acertos19 + $acertos20);

		if( $total > 40){
			$result['soma_total'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

		if( $acertos0 > 3){
			$result['acerto0'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

		if( $acertos15 > 33){
			$result['acerto15'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

		if( $acertos16 > 7){
			$result['acerto16'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

		if( $acertos17 > 1){
			$result['acerto17'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

		if( $acertos18 > 1){
			$result['acerto18'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

		if( $acertos19 > 1){
			$result['acerto19'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

		if( $acertos20 > 1){
			$result['acerto20'][] = ['aposta' => $aposta['aposta'], 'acertos' => ['0x' => $acertos0, '15x' => $acertos15, '16x' => $acertos16, '17x' => $acertos17, '18x' => $acertos18, '19x' => $acertos19, '20x' => $acertos20, 'soma' => $total]];
		}

	}

	return $result;

}

function comparacao($sorteio, $aposta){
	$sorteio = explode(',', $sorteio["bolas_sorteadas"]);
	$aposta = explode(',', $aposta["sequencia"]);
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
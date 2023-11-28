<?php

class RelatoError {

	/**
	 * Lista de erros
	 *
	 * @var array
	 */
	private $errors;

	public function __construct() {
		$this->errors = [
			'ERRO'                                       => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 01',
			'USUARIO BLOQUEADO'                          => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 02',
			'ACESSO BLOQUEADO'                           => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 02',
			'USUARIO\/SENHA INVALIDO'                    => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 03',
			'INCONSISTENCIAS NOS DADOS ENVIADOS'         => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 04',
			'VIOLACAO DOS CONTROLES DE CONVERSACAO'      => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 05',
			'LIGUE PARA O FORNECEDOR'                    => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 06',
			'USUARIO NAO AUTORIZADO'                     => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 07',
			'Internal Server Error'                      => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 08',
			'NAO EXISTENTE'                              => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 09',
			'ERRO CONVERSACAO FUNCAO'                    => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 10',
			'NAO FOI POSSIVEL ATENDER A SUA SOLICITACAO' => 'teste',
			'USUARIO NAO AUTORIZADO PARA NRSR'			 => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 07'
		];
	}

	public function ckeckError($resposta) {

		$log['resposta'] = $resposta;

		foreach ($this->errors as $key => $error) {

			if (preg_match("/\b$key\b/", $resposta)) {
				$log['key'] = $key;
                $log['if'] = preg_match("/\b$key\b/", $resposta);
                $log['resposta_arr'] = $resposta;
                $log['error'] = $error;
				print_r($log);
				return $error;
			}
		}

		return false;
	}
}


// function ckeckError($resposta) {

//     $log['resposta'] = $resposta;
	
// 	$errors = [
// 			'ERRO'                                       => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 01',
// 			'USUARIO BLOQUEADO'                          => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 02',
// 			'ACESSO BLOQUEADO'                           => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 02',
// 			'USUARIO\/SENHA INVALIDO'                    => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 03',
// 			'INCONSISTENCIAS NOS DADOS ENVIADOS'         => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 04',
// 			'VIOLACAO DOS CONTROLES DE CONVERSACAO'      => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 05',
// 			'LIGUE PARA O FORNECEDOR'                    => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 06',
// 			'USUARIO NAO AUTORIZADO'                     => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 07',
// 			'Internal Server Error'                      => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 08',
// 			'NAO EXISTENTE'                              => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 09',
// 			'ERRO CONVERSACAO FUNCAO'                    => 'FORNECEDOR EM MANUTENÇÃO! CODIGO: 10',
// 			'NAO FOI POSSIVEL ATENDER A SUA SOLICITACAO' => 'teste'
// 		];

// 		foreach ($errors as $key => $error) {
// 			if (preg_match("/\b$key\b/", $resposta)) {
//                 $log['key'] = $key;
//                 $log['if'] = preg_match("/\b$key\b/", $resposta);
//                 $log['resposta_arr'] = $resposta;
//                 $log['error'] = $error;
//                 print_r($log);
// 				return $error;
// 			}
// 		}

// 		return false;
// 	}
	
	
$resposta = "#INI0138IP20RTMI89708901 USUARIO NAO AUTORIZADO PARA NRSR           06116543                                                      #FIM9999";

$relato = new RelatoError();

print_r($relato->ckeckError($resposta));
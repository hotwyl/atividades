<?php

// https://www.mazusoft.com.br/lotofacil/resultados.php
// https://www.mazusoft.com.br/lotomania/resultados.php

set_time_limit(180);

class LoteriaData {
    public array $base_lf;
    public array $sorteio_lf;
    public array $aposta_lf;
    public array $base_lm;
    public array $sorteio_lm;
    public array $aposta_lm;

    public function __construct(array $data) {
        
        $this->base_lf = (array) $data['base_lf'];
        $this->sorteio_lf = $data['sorteio_lf'];
        $this->aposta_lf = $data['aposta_lf'];
        $this->base_lm = (array) $data['base_lm'];
        $this->sorteio_lm = $data['sorteio_lm'];
        $this->aposta_lm = $data['aposta_lm'];

    }
}

class LoteriaGenerator {
    private array $numeros_mais_sorteados = [];
    private array $result = [];
    private int $ts = 0;

    public function buscaDadosLF(array $sorteios, array $apostas): array {
        $this->reset();

        foreach ($apostas as $aposta) {
            $aposta = isset($aposta["bolas_sorteadas"]) ? [$aposta["bolas_sorteadas"]] : $aposta;
            $this->inicializaVariaveis();

            foreach ($sorteios as $sorteio) {
                $this->processaSorteio($sorteio, $aposta);
            }

            $this->atualizaResultados($aposta);
        }

        $this->result['numeros_mais_sorteados'] = $this->numeros_mais_sorteados;

        return $this->result;
    }

    public function buscaDadosLM(array $sorteios, array $apostas): array {
        $this->reset();

        foreach ($apostas as $aposta) {
            $aposta = isset($aposta["bolas_sorteadas"]) ? [$aposta["bolas_sorteadas"]] : $aposta;
            $this->inicializaVariaveis();

            foreach ($sorteios as $sorteio) {
                $this->processaSorteio($sorteio, $aposta);
            }

            $this->atualizaResultados($aposta);
        }

        $this->result['numeros_mais_sorteados'] = $this->numeros_mais_sorteados;

        return $this->result;
    }


    private function reset(): void {
        $this->numeros_mais_sorteados = [];
        $this->result = [];
        $this->ts = 0;
    }

    private function inicializaVariaveis(): void {
        $this->t11 = 0;
        $this->t12 = 0;
        $this->t13 = 0;
        $this->t14 = 0;
        $this->t15 = 0;
    }

    private function processaSorteio(array $sorteio, array $aposta): void {
        $bolas_sorteadas = explode(',', $sorteio["bolas_sorteadas"]);

        foreach ($bolas_sorteadas as $bola) {
            $this->numeros_mais_sorteados[$bola] = ($this->numeros_mais_sorteados[$bola] ?? 0) + 1;
        }

        $comparacao = $this->comparacao($sorteio, $aposta);

        switch ($comparacao['qtd_acertos']) {
            case 11: $this->t11++; break;
            case 12: $this->t12++; break;
            case 13: $this->t13++; break;
            case 14: $this->t14++; break;
            case 15: $this->t15++; break;
        }
    }

    private function comparacao(array $sorteio, array $aposta): array {
        $sorteio = explode(',', $sorteio["bolas_sorteadas"]);
        $aposta = explode(',', $aposta[0]);
        $qtd_acertos = 0;
        $num_acertos = [];

        foreach ($sorteio as $s) {
            foreach ($aposta as $a) {
                if ($s == $a) {
                    $num_acertos[] = $a;
                    $qtd_acertos++;
                }
            }
        }

        return ['qtd_acertos' => $qtd_acertos, 'num_acertos' => $num_acertos];
    }

    private function atualizaResultados(array $aposta): void {
        $soma = $this->t11 + $this->t12 + $this->t13 + $this->t14 + $this->t15;

        if ($soma > $this->ts) {
            $this->ts = $soma;
            $this->result['melhor_jogo_geral'][] = [
                'aposta' => $aposta[0],
                'acertos' => ['11x' => $this->t11, '12x' => $this->t12, '13x' => $this->t13, '14x' => $this->t14, '15x' => $this->t15, 'soma' => $soma]
            ];
        }
    }
}

class GeradorApostasLoteria {
    private $numerosDisponiveis;
    private $quantidadeNumeros;

    public function __construct(array $numerosDisponiveis, int $quantidadeNumeros) {
        $this->numerosDisponiveis = $numerosDisponiveis;
        $this->quantidadeNumeros = $quantidadeNumeros;
    }

    public function gerarAposta() {
        $aposta = array_rand(array_flip($this->numerosDisponiveis), $this->quantidadeNumeros);
        sort($aposta);
        return $aposta;
    }
}

$dados = json_decode(file_get_contents('dadosLoteria.json'), true);
$loteriaData = new LoteriaData($dados);

$loteriaGenerator = new LoteriaGenerator();

$_GET['oper'] = 'lf2';
$qtd = isset($_GET['qtd']) && !empty($_GET['qtd']) ? intval($_GET['qtd']) : 1;

switch (trim(addslashes($_GET['oper']))) {
    case 'compara_lf1':
        echo json_encode($loteriaGenerator->buscaDadosLF($loteriaData->sorteio_lf, $loteriaData->aposta_lf));
        break;
    
    case 'compara_lf2':
        echo json_encode($loteriaGenerator->buscaDadosLF($loteriaData->sorteio_lf, $loteriaData->sorteio_lf));
        break;

    case 'compara_lm1':
        echo json_encode($loteriaGenerator->buscaDadosLM($loteriaData->sorteio_lm, $loteriaData->aposta_lm));
        break;

    case 'compara_lm2':
        echo json_encode($loteriaGenerator->buscaDadosLM($loteriaData->sorteio_lm, $loteriaData->sorteio_lm));
        break;

    case 'gerador_lotomania':
        $numerosDisponiveisLotomania = range(1, 100); // Números de 1 a 100 na Lotomania
        $quantidadeNumerosLotomania = 50; // Quantidade de números na Lotomania

        $geradorLotomania = new GeradorApostasLoteria($numerosDisponiveisLotomania, $quantidadeNumerosLotomania);

        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['lotomania'][] = $geradorLotomania->gerarAposta();
        }

    case 'gerador_lotofacil':
        $numerosDisponiveisLotofacil = range(1, 25); // Números de 1 a 25 na Lotofácil
        $quantidadeNumerosLotofacil = 15; // Quantidade de números na Lotofácil

        $geradorLotofacil = new GeradorApostasLoteria($numerosDisponiveisLotofacil, $quantidadeNumerosLotofacil);

        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['lotofacil'][] = $geradorLotofacil->gerarAposta();
        }

        echo json_encode($aposta);
        break;

    case 'gerador_megaSena':
        $numerosDisponiveisMegaSena = range(1, 60); // Números de 1 a 60 na Mega-Sena
        $quantidadeNumerosMegaSena = 6; // Quantidade de números na Mega-Sena
        
        $geradorMegaSena = new GeradorApostasLoteria($numerosDisponiveisMegaSena, $quantidadeNumerosMegaSena);
        
        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['megaSena'][] = $geradorMegaSena->gerarAposta();
        }

        echo json_encode($aposta);
        break;

    case 'gerador_quina':
        $numerosDisponiveisQuina = range(1, 80); // Números de 1 a 80 na Quina
        $quantidadeNumerosQuina = 5; // Quantidade de números na Quina

        $geradorQuina = new GeradorApostasLoteria($numerosDisponiveisQuina, $quantidadeNumerosQuina);

        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['quina'][] = $geradorQuina->gerarAposta();
        }

        echo json_encode($aposta);
        break;

    case 'gerador_duplaSena':
        $numerosDisponiveisDuplaSena = range(1, 50); // Números de 1 a 50 na Dupla Sena
        $quantidadeNumerosDuplaSena = 6; // Quantidade de números na Dupla Sena
        
        $geradorDuplaSena = new GeradorApostasLoteria($numerosDisponiveisDuplaSena, $quantidadeNumerosDuplaSena);
        
        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['duplaSena'][] = $geradorDuplaSena->gerarAposta();
        }

        echo json_encode($aposta);
        break;

    case 'gerador_diaDeSorte':
        $numerosDisponiveisDiaDeSorte = range(1, 31); // Números de 1 a 31 no Dia de Sorte
        $quantidadeNumerosDiaDeSorte = 7; // Quantidade de números no Dia de Sorte
        
        $geradorDiaDeSorte = new GeradorApostasLoteria($numerosDisponiveisDiaDeSorte, $quantidadeNumerosDiaDeSorte);
        
        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['diaDeSorte'][] = $geradorDiaDeSorte->gerarAposta();
        }

        echo json_encode($aposta);
        break;
    
    case 'gerador_superSete':
        $numerosDisponiveisSuperSete = range(1, 10); // Números de 1 a 10 no Super Sete
        $quantidadeNumerosSuperSete = 7; // Quantidade de números no Super Sete
        
        $geradorSuperSete = new GeradorApostasLoteria($numerosDisponiveisSuperSete, $quantidadeNumerosSuperSete);
        
        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['superSete'][] = $geradorSuperSete->gerarAposta();
        }

        echo json_encode($aposta);
        break;

    case 'gerador_milionaria':
        $numerosDisponiveisMilionaria = range(1, 80); // Números de 1 a 80 no +Milionária
        $quantidadeNumerosMilionaria = 7; // Quantidade de números no +Milionária
        
        $geradorMilionaria = new GeradorApostasLoteria($numerosDisponiveisMilionaria, $quantidadeNumerosMilionaria);
        
        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['milionaria'][] = $geradorMilionaria->gerarAposta();
        }

        echo json_encode($aposta);
        break;

    case 'gerador_timemania':
        $numerosDisponiveisTimemania = range(1, 80); // Números de 1 a 80 na Timemania
        $quantidadeNumerosTimemania = 10; // Quantidade de números na Timemania
        
        $geradorTimemania = new GeradorApostasLoteria($numerosDisponiveisTimemania, $quantidadeNumerosTimemania);
        
        for ($i = 1; $i <= $qtd; $i++) {
            $aposta['timemania'][] = $geradorTimemania->gerarAposta();
        }

        echo json_encode($aposta);
        break;

    // Adicione mais casos conforme necessário...

    default:
        echo json_encode('nenhuma opção válida.');
        break;
}

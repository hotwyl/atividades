<?php

interface CalculadoraInterface {
    public function calcularValorHora(float $salarioMensal): float;
    public function calcularValorProjeto(float $horasEstimadas): float;
}

abstract class CalculadoraBase implements CalculadoraInterface {
    protected float $valorHora;

    public function __construct(float $valorHora) {
        $this->valorHora = $valorHora;
    }

    public function calcularValorHora(float $salarioMensal): float {
        // Considerando 4 semanas e 5 dias úteis por semana
        return $salarioMensal / (4 * 5 * 8);
    }

    public function calcularValorProjeto(float $horasEstimadas): float {
        return $this->valorHora * $horasEstimadas;
    }

    public function getValorHora(): float {
        return $this->valorHora;
    }

    public function setValorHora(float $valorHora): void {
        $this->valorHora = $valorHora;
    }
}

class CalculadoraFreelance extends CalculadoraBase {
    public function __construct(float $valorHora) {
        parent::__construct($valorHora);
    }
}

class FreelancerAPI {
    private CalculadoraInterface $calculadora;

    public function __construct(CalculadoraInterface $calculadora) {
        $this->calculadora = $calculadora;
    }

    public function setValorHora(float $valorHora): void {
        $this->calculadora->setValorHora($valorHora);
    }

    public function calcularValorHora(float $salarioMensal): float {
        return $this->calculadora->calcularValorHora($salarioMensal);
    }

    public function calcularValorProjeto(float $horasEstimadas): float {
        return $this->calculadora->calcularValorProjeto($horasEstimadas);
    }
}


function validaCampos($tipoInfoproduto, $servicosAdicionais) {
    $validaCampos = array();

    if (empty($tipoInfoproduto)) {
        $validaCampos[] = "Selecione um tipo de infoproduto.";
    }

    if (empty($servicosAdicionais)) {
        $validaCampos[] = "Selecione um serviço adicional.";
    }

    if (!$tipoInfoproduto) {
        $validaCampos[] = "Falha identificada. Não foi identificado um valor válido para o campo Infoprodutos. O preenchimento do campo Infoprodutos é obrigatório.";
    }

    // if (!$servicosAdicionais) {
    //     $error[] = "Falha identificada. Não foi identificado um valor válido para o campo Serviços Adicionais. O preenchimento do campo Serviços Adicionais é obrigatório.";
    // }

    return $validaCampos;
}

function getOrcInfoProd($tipoInfoproduto, $valorTotal, $horasTotais, $maoDEobra) {
    $valor = 0;
    $horas = 0;
    $descr = [];

    foreach ($tipoInfoproduto as $infoproduto) {

        switch (trim($infoproduto)) {
            case 'ebook':
                $valor = 50;
                $horas = 10;
                $descr[] = 'Ebook';
                break;
            case 'webinar':
                $valor = 80;
                $horas = 12;
                $descr[] = 'Eebinar';
                break;
            case 'palestra':
                $valor = 120;
                $horas = 8;
                $descr[] = 'Palestra';
                break;
            case 'aplicativo':
                $valor = 900;
                $horas = 100;
                $descr[] = 'Aplicativo';
                break;
            case 'consultoria':
                $valor = 200;
                $horas = 9;
                $descr[] = 'Consultoria';
                break;
            case 'podcast':
                $valor = 70;
                $horas = 10;
                $descr[] = 'Pod-Cast';
                break;
            case 'video_aulas':
                $valor = 150;
                $horas = 10;
                $descr[] = 'Video Aulas';
                break;
            case 'template_website':
                $valor = 250;
                $horas = 25;
                $descr[] = 'Template Website';
                break;
            case 'e_learning':
                $valor = 180;
                $horas = 15;
                $descr[] = 'E-learning';
                break;
            case 'coaching':
                $valor = 220;
                $horas = 8;
                $descr[] = 'Coaching';
                break;
            case 'curso_presencial':
                $valor = 400;
                $horas = 15;
                $descr[] = 'Curso Presencial';
                break;
            case 'software':
                $valor = 350;
                $horas = 100;
                $descr[] = 'Software';
                break;
            case 'templates_graficos':
                $valor = 180;
                $horas = 11;
                $descr[] = 'Templates Graficos';
                break;
            case 'workshop':
                $valor = 280;
                $horas = 6;
                $descr[] = 'Workshop';
                break;
            case 'aplicativo_mobile':
                $valor = 400;
                $horas = 100;
                $descr[] = 'Aplicativo Mobile';
                break;
            case 'arte_digital':
                $valor = 150;
                $horas = 15;
                $descr[] = 'Arte Digital';
                break;
            case 'curso_idiomas':
                $valor = 180;
                $horas = 15;
                $descr[] = 'Curso Idiomas';
                break;
            case 'e_commerce':
                $valor = 350;
                $horas = 100;
                $descr[] = 'E-commerce';
                break;
            case 'curso_online':
                $valor = 200;
                $horas = 25;
                $descr[] = 'Curso Online';
                break;
            case 'master_class':
                $valor = 200;
                $horas = 10;
                $descr[] = 'Master Class';
                break;
            case 'mentoria':
                $valor = 200;
                $horas = 10;
                $descr[] = 'Mentoria';
                break;

        }

        $valorTotal += $valor + ($maoDEobra*$horas);
        $horasTotais += $horas;
    }
    
    return [
        "total" => floatval($valorTotal), 
        "horas" => intval($horasTotais),
        "descricao" => implode(' + ', $descr)
    ];
}

function getServAdicional($servicosAdicionais, $valorTotal, $horasTotais, $maoDEobra) {
    $valor = 0;
    $horas = 0;
    $descr = [];

    foreach ($servicosAdicionais as $servico) {
        switch ($servico) {
            case 'estrategia_marketing':
                $valor = 200;
                $horas = 10;
                $descr[] = 'Estrategia Marketing';
                break;
            case 'suporte_tecnico':
                $valor = 100;
                $horas = 10;
                $descr[] = 'Suporte Tecnico';
                break;
            case 'design_grafico':
                $valor = 150;
                $horas = 10;
                $descr[] = 'Design Grafico';
                break;
            case 'traducao':
                $valor = 50;
                $horas = 10;
                $descr[] = 'Traducao';
                break;
            case 'edicao_video':
                $valor = 120;
                $horas = 10;
                $descr[] = 'Edicao Video';
                break;
            case 'criacao_conteudo':
                $valor = 100;
                $horas = 10;
                $descr[] = 'Criação Conteudo';
                break;
            case 'revisao_conteudo':
                $valor = 80;
                $horas = 10;
                $descr[] = 'Revisao Conteudo';
                break;
            case 'hospedagem_multimidia':
                $valor = 90;
                $horas = 10;
                $descr[] = 'Hospedagem Multimidia';
                break;
            case 'servico_redacao':
                $valor = 70;
                $horas = 10;
                $descr[] = 'Servico Redação';
                break;
            case 'instalacao_software':
                $valor = 180;
                $horas = 10;
                $descr[] = 'Instalação Software';
                break;
            case 'consultoria_marketing':
                $valor = 300;
                $horas = 10;
                $descr[] = 'Consultoria Marketing';
                break;
            case 'gerenciamento_projetos':
                $valor = 180;
                $horas = 10;
                $descr[] = 'Gerenciamento Projetos';
                break;
            case 'servico_transcricao':
                $valor = 60;
                $horas = 10;
                $descr[] = 'Servico Transcricao';
                break;
            case 'gerenciamento_anuncios':
                $valor = 180;
                $horas = 10;
                $descr[] = 'Gerenciamento Anuncios';
                break;
            case 'criacao_logotipo':
                $valor = 100;
                $horas = 10;
                $descr[] = 'Criação Logotipo';
                break;
            case 'suporte_tecnico':
                $valor = 90;
                $horas = 10;
                $descr[] = 'Suporte Tecnico';
                break;
            case 'pagina_vendas':
                $valor = 300;
                $horas = 10;
                $descr[] = 'Pagina Vendas';
                break;
            case 'pagina_captura':
                $valor = 250;
                $horas = 10;
                $descr[] = 'Pagina Captura';
                break;
            case 'email_marketing':
                $valor = 180;
                $horas = 10;
                $descr[] = 'Email Marketing';
                break;
            case 'identidade_visual':
                $valor = 200;
                $horas = 10;
                $descr[] = 'Identidade Visual';
                break;
            case 'hot_site':
                $valor = 220;
                $horas = 10;
                $descr[] = 'HotSite';
                break;
        }

        $valorTotal += $valor + ($maoDEobra*$horas);
        $horasTotais += $horas;
    }

    return [
        "total" => floatval($valorTotal), 
        "horas" => intval($horasTotais),
        "descricao" => implode(' + ', $descr)
    ];
}

function calcularOrcamento($tipoInfoproduto, $servicosAdicionais) {
    $maoDEobra = 50; // Valor por hora de duração do curso
    $prazoEstimado = 0; // Prazo estimado para conclusão do projeto em dias
    $horasPorDia = 4; // Quantidade de horas trabalhadas por dia
    $horasTotais = 0;
    $valorTotal = 0;

    $orcInfoProd = getOrcInfoProd($tipoInfoproduto, $valorTotal, $horasTotais, $maoDEobra);

    $servAdicional = getServAdicional($servicosAdicionais, $valorTotal, $horasTotais, $maoDEobra);

    $horasTotais = intval($orcInfoProd['horas'] + $servAdicional['horas']);
    $valorTotal = floatval($orcInfoProd['total'] + $servAdicional['total']);
    $prazoEstimado = ceil($horasTotais / $horasPorDia);

    // Retornando o valor total e o prazo estimado
    return ['valorTotal' => floatval($valorTotal), 'prazoEstimado' => intval($prazoEstimado)];
}

function analiseDeRisco($descricaoRisco, $probabilidade, $impacto, $descricaoImpacto, $tipoAcao, $acoes, $responsavel, $previsaoExecucao, $statusAcao, $comentarios = "") {
    $analiseRisco = array(
        'descricaoRisco' => $descricaoRisco,
        'probabilidade' => $probabilidade,
        'impacto' => $impacto,
        'descricaoImpacto' => $descricaoImpacto,
        'tipoAcao' => $tipoAcao,
        'acoes' => $acoes,
        'responsavel' => $responsavel,
        'previsaoExecucao' => $previsaoExecucao,
        'statusAcao' => $statusAcao,
        'comentarios' => $comentarios
    );

    return $analiseRisco;
}

function analiseSWOT($forcas, $fraquezas, $oportunidades, $ameacas) {
    $analiseSWOT = array(
        'Forcas' => $forcas,
        'Fraquezas' => $fraquezas,
        'Oportunidades' => $oportunidades,
        'Ameacas' => $ameacas
    );

    return $analiseSWOT;
}

function calcInfra($dominio, $hospedagem, $seguranca, $monitoramento, $emailPro, $dt) {

    $maoDEobra = $dt['maoDEobra'];
    $horasPorPagina = $dt['horasPorPagina'];
    $horasPorFuncionalidade = $dt['horasPorFuncionalidade'];
    $horasPorHoraExtra = $dt['horasPorHoraExtra'];
    $qtd_h = 0;
    $descricao = [];
    $val = [];

    if ($dominio){
        $val['dominio'] = floatval($dominio);
        $qtd_h = $qtd_h + 1;
        $descricao[] = 'Contratação e econfiguração de dominio';
    } 

    if ($hospedagem){
        $qtd_h = $qtd_h + 1;
        $val['hospedagem'] = floatval($hospedagem * 12);
        $descricao[] = 'Contratação e econfiguração de Hospedagem para siste ou sistema';
    } 

    if ($seguranca){
        $qtd_h = $qtd_h + 3;
        $val['seguranca'] = floatval($seguranca * 12);
        $descricao[] = 'Configuração sistema de Segurança Cloudflare';
    } 

    if ($monitoramento){
        $qtd_h = $qtd_h + 1;
        $val['monitoramento'] = floatval($monitoramento * 12);
        $descricao[] = 'Configuração sistema de Analytics para Metricas de Trafego';
    } 

    if ($emailPro){
        $qtd_h = $qtd_h + 1;
        $val['emailPro'] = floatval($emailPro * 12);
        $descricao[] = 'Configuração Email Profissional para dominio proprio.';
    }

    $horasExtras = ($qtd_h * $horasPorHoraExtra) / 100;

    $qth = ceil($qtd_h + $horasExtras);

    $vlr_total = array_sum($val) + (($maoDEobra * $qth) / 2);

    if ($vlr_total > 0) {
        return array_merge($val, ["totalCusto" => $vlr_total, "descricaoInfra" => implode(' + ', $descricao), "totalHoras" => $qth]);
    } else {
        return false;
    }
}

function calcAplicacao($servico, $paginas, $designe, $dt) {
    $qtdPg = ($paginas > 0) ? $paginas : 1;
    $maoDEobra = $dt['maoDEobra'];
    $horasPorPagina = $dt['horasPorPagina'];
    $horasPorFuncionalidade = $dt['horasPorFuncionalidade'];
    $horasPorHoraExtra = $dt['horasPorHoraExtra'];

    switch ($servico) {
        case 'blog':
            $serv = 550;
            $vlrOper = $maoDEobra * 6;
            $descricao = 'Blog';
            $pgPadrao = 'Pagina Inicial com seção Sobre, Menu de Navegação compossibilidade de links externos, Seção Contato, Seção destaque';
            $numeroPaginas = $qtdPg;
            $numeroFuncionalidades = 0;
            break;
        case 'institucional':
            $serv = 690;
            $vlrOper = $maoDEobra * 8;
            $descricao = 'Site Institucional';
            $pgPadrao = 'Pagina inicial, Pagina Contato, Pagina Institucional ou Sobre, Pagina Serviços ou Produtos, Pagina Blog';
            $numeroPaginas = $qtdPg;
            $numeroFuncionalidades = 0;
            break;
        case 'lojaVirtual':
            $serv = 730;
            $vlrOper = $maoDEobra * 12;
            $descricao = 'Loja Virtual / E-Commerce';
            $pgPadrao = 'Pagina Inicial em formato Vitrine, Paginas de Produtos, Pagina de Contato e atendimento, pagina blog';
            $numeroPaginas = $qtdPg;
            $numeroFuncionalidades = 0;
            break;
        case 'landingPage':
            $serv = 710;
            $vlrOper = $maoDEobra * 6;
            $descricao = 'Landing Page / Pagina de Venda / Pagina de Captura';
            $pgPadrao = 'Pagina Inicial com seção apresentação, seção descrição, seção cta, seção prova social, seção faque, seção tomada decisão';
            $numeroPaginas = $qtdPg;
            $numeroFuncionalidades = 0;
            break;
        case 'manutencao':
            $serv = 500;
            $vlrOper = $maoDEobra * 7;
            $descricao = 'Manutenção / Migração';
            $pgPadrao = '';
            break;
        case 'sistema':
            $serv = 500;
            $vlrOper = $maoDEobra * 7;
            $descricao = 'Desenvolvimento de Sistema';
            $pgPadrao = '';
            $numeroFuncionalidades = $qtdPg;
            $numeroPaginas = 0;
            break;
        default:
            $serv = 500;
            $vlrOper = $maoDEobra * 5;
            $descricao = '';
            break;
    }

    $horasDesenvolvimento = ($horasPorPagina * $numeroPaginas) + ($horasPorFuncionalidade * $numeroFuncionalidades);

    $horasExtras = ($horasDesenvolvimento * $horasPorHoraExtra) / 100;

    $th = $horasDesenvolvimento + $horasExtras;

    $valor = ($qtdPg * $serv) + $vlrOper + $designe;

    return [
        "custoAplicacao" => $valor,
        "descricaoAplicacao" => $descricao,
        "paginasPadrao" => $pgPadrao,
        "totalHoras" => $th
    ];
}

function calcIntegracao($sistemaEntrega, $meioPagamento, $canaisComerciais, $automacaoAtendimento, $emailMarketing, $interacaoRedeSociais, $dt) {

    $maoDEobra = $dt['maoDEobra'];
    $horasPorPagina = $dt['horasPorPagina'];
    $horasPorFuncionalidade = $dt['horasPorFuncionalidade'];
    $horasPorHoraExtra = $dt['horasPorHoraExtra'];
    $qtd_h = 0;
    $descricao = [];
    $val = [];

    if ($sistemaEntrega) {
        $val['sistemaEntrega'] = floatval($sistemaEntrega + ($maoDEobra * 3));
        $qtd_h = $qtd_h + 3;
        $descricao[] = 'Sistema de Entrega';
    }

    if ($meioPagamento) {
        $val['meioPagamento'] = floatval($meioPagamento + ($maoDEobra * 2));
        $qtd_h = $qtd_h + 2;
        $descricao[] = 'Meios de Pagamento';
    }

    if ($canaisComerciais) {
        $val['canaisComerciais'] = floatval($canaisComerciais + ($maoDEobra * 3));
        $qtd_h = $qtd_h + 3;
        $descricao[] = 'Canais Comerciais';
    }

    if ($automacaoAtendimento) {
        $val['automacaoAtendimento'] = floatval($automacaoAtendimento + ($maoDEobra * 5));
        $qtd_h = $qtd_h + 5;
        $descricao[] = 'Automatização Processos Comerciais';
    }

    if ($emailMarketing) {
        $val['emailMarketing'] = floatval($emailMarketing + ($maoDEobra * 2));
        $qtd_h = $qtd_h + 2;
        $descricao[] = 'Email Marketing';
    }

    if ($interacaoRedeSociais) {
        $val['interacaoRedeSociais'] = floatval($interacaoRedeSociais + ($maoDEobra * 2));
        $qtd_h = $qtd_h + 2;
        $descricao[] = 'Integração Redes Sociais';
    }

    $horasExtras = ($qtd_h * $horasPorHoraExtra) / 100;

    $qth = ceil($qtd_h + $horasExtras);


    $vlr_total = array_sum($val) + (($maoDEobra * $qth) / 2);

    if ($vlr_total > 0) {
        return array_merge($val, ["custoIntegracaoes" => $vlr_total, "descricaoIntegracao" => implode(' + ', $descricao), "totalHoras" => $qth]);
    } else {
        return false;
    }
}

function calcManutencao($planoManutencao, $resulAplicacao, $dt) {


    if ($planoManutencao) {
        $plano = '';
        switch($planoManutencao) {
            case 'trimestral':
                $plano = 'Trimestral';
                break;

            case 'semestral':
                $plano = 'Semestral';
                break;

            case 'anual':
                $plano = 'Anual';
                break;
            default:
                $plano = 'Trimestral';
                break;
        }

        $valorTotal = floatval(200) + floatval($dt['maoDEobra'] * 1.3) + floatval($resulAplicacao['custoAplicacao']) * 0.1;

        return [
            "custoManutencao" => $valorTotal,
            "planoManutencao" => $plano,
            "descricaoManutencao" => [
                    'Manutenção de servidores',
                    'Manutenção de banco de dados',
                    'Manutenção de hospedagem',
                    'Manutenção de domínio',
                    'Manutenção de e-mail',
                    'Manutenção de SSL',
                    'Manutenção de CDN',
                    'Manutenção de cache',
                    'Manutenção de firewall',
                    'Manutenção de backup',
                    'Manutenção de monitoramento',
                    'Manutenção de segurança',
                    'Manutenção de performance',
                    'Manutenção de acessibilidade',
                    'Manutenção de responsividade',
                    'Manutenção de compatibilidade',
                    'Manutenção de SEO',
                    'Manutenção de integrações',
                    'Manutenção de conteúdo',
                    'Manutenção de layout',
                    'Manutenção de plugins',
                    'Manutenção de temas',
                    'Manutenção de versões',
                ]
            ];
    } else {
        return false;
    }
}

// function processaOrcamento(resulInfra, resulAplicacao, resulIntegracao, resulManutencao) {

//     let integra = (resulIntegracao != '') ? resulIntegracao.custoIntegracaoes : 0
//     let infra = (resulInfra != '') ? resulInfra.totalCustoInfra : 0
//     let manutencao = (resulManutencao != '') ? resulManutencao.custoManutencao : 0

//     $soma = parseFloat(infra) + parseFloat(resulAplicacao.custoAplicacao) + parseFloat(integra)

//     $resul = {}

//     resul.aplicacao = 'Desenvolvimento de ' + resulAplicacao.descricaoAplicacao + ' com páginas padrão.'
//     resul.custo = 'O custo total do projeto é de R$ ' + parseFloat(soma).toFixed(2)
//     resul.pagamento = 'O pagamento pode ser feito em 2 vezes sendo 50% no inicio e 50% na entrega do projeto.'
//     resul.inicio = 'O Start do projeto se dá no ato de confirmação e assinatura de contrato.'
//     resul.prazo = 'O prazo de desenvolvimento é de 48h (equivalente a 6 dias uteis com 8 horas diárias). Podendo estender para o prazo máximo de entrega do projeto de 15 dias corrido.'
//     if (resulManutencao != '') {
//         resul.manutencao = 'O custo de manutenção do projeto é de R$ ' + parseFloat(manutencao).toFixed(2) + ' mensal no periodo do plano ' + resulManutencao.planoManutencao + '. Este é Opcional podendo ser contratado a parte.'
//     }
//     resul.alteracao = 'Após definição do escopo do projeto terá direito a 3 correções podendo ser 1 delas alteração de layout.'
//     resul.conograma = 'O cronograma de desenvolvimento do projeto será enviado após a assinatura do contrato.'
//     resul.fases = 'O projeto será desenvolvido em 3 fases sendo elas: Infraestrutura, Aplicação e Integrações.'
//     resul.etapas = 'As etapas de desenvolvimento do projeto serão: Análise de Requisitos, Desenvolvimento, Testes e Implantação.'
//     if (resulInfra != '') {
//         resul.infraestrutura = 'O custo da infraestrutura é de R$ ' + parseFloat(infra).toFixed(2) + ' sendo composto por: ' + resulInfra.descricaoInfra
//     }
//     if (integra != 0) {
//         resul.integracoes = 'O custo das integrações é de R$ ' + parseFloat(integra).toFixed(2) + ' sendo composto por: ' + resulIntegracao.descricaoIntegracao
//     }
//     return resul

// }

function orcamentoDesenvolvimento($dados) {
    // Definir custos baseados no tipo e tamanho do projeto

    // Exemplo de uso da função
    $tamanhoProjeto = $dados['tamanhoProjeto'];
    $dominio = ($dados['dominio'] == false) ? 0 : 90;
    $hospedagem = ($dados['hospedagem']== false) ? 0 : 50;
    $seguranca = ($dados['seguranca'] == false) ? 0 : 0;
    $monitoramento = ($dados['monitoramento'] == false) ? 0 : 0;
    $emailPro = ($dados['emailPro'] == false) ? 0 : 0;
    $identidadeVisual = ($dados['identidadeVisual'] == false) ? 0 : 150;
    $sistemaEntrega = ($dados['sistemaEntrega'] == false) ? 0 : 80;
    $meioPagamento = ($dados['meioPagamento'] == false) ? 0 : 90;
    $canaisComerciais = ($dados['canaisComerciais'] == false) ? 0 : 65;
    $automacaoAtendimento = ($dados['automacaoAtendimento'] == false) ? 0 : 50;
    $emailMarketing = ($dados['emailMarketing'] == false) ? 0 : 80;
    $interacaoRedeSociais = ($dados['interacaoRedeSociais'] == false) ? 0 : 75;
    $servico = $dados['tipoProjeto'];
    $paginas = $dados['tamanhoProjeto'];
    $planoManutencao = ($dados['manutencao'] == false) ? false : $dados['manutencao'];
    $designe = $identidadeVisual;
    
    $dt = [
        "maoDEobra" => 50, // Custo médio por hora de desenvolvimento
        "horasPorPagina" => 8, // Horas estimadas de desenvolvimento por página
        "horasPorFuncionalidade" => 16, // Horas estimadas de desenvolvimento por funcionalidade
        "horasPorHoraExtra" => 10 // Horas extras estimadas para possíveis imprevistos
    ];

    $infra = calcInfra($dominio, $hospedagem, $seguranca, $monitoramento, $emailPro, $dt);

    $aplicacao = calcAplicacao($servico, $paginas, $designe, $dt);

    $integracao = calcIntegracao($sistemaEntrega, $meioPagamento, $canaisComerciais, $automacaoAtendimento, $emailMarketing, $interacaoRedeSociais, $dt);

    $manutencao = calcManutencao($planoManutencao, $aplicacao, $dt);

    $arrPrazos = [
        'Definição de requisitos' => 5,
        'Design e prototipagem' => 10,
        'Infraestrutura' => ($infra) ? $infra['totalHoras'] : 0,
        'Desenvolvimento' => ($aplicacao) ? $aplicacao['totalHoras'] : 0,
        'Integracao' => ($integracao) ? $infra['totalHoras'] : 0,
        'Testes e correções' => 10,
        'Implantação' => 5,
        'Acompanhamento pós-implantação' => 5,
        'horasPorHoraExtra' => $dt['horasPorHoraExtra']
    ];

    // Calcular prazo total estimado somando as etapas
    $prazoTotal = array_sum($arrPrazos);    

    // Definir prazo estimado (considerando 8 horas de trabalho por dia)
    $diasEstimados = ceil($prazoTotal / 8);

    $arrValores = [
        'Infraestrutura' => ($infra) ? $infra['totalCusto'] : 0,
        'Desenvolvimento' => ($aplicacao) ? $aplicacao['custoAplicacao'] : 0,
        'Integracao' => ($integracao) ? $integracao['custoIntegracaoes'] : 0,
        'manutencao' => ($manutencao) ? $manutencao['custoManutencao'] : 0
    ];

    $custoTotal = array_sum($arrValores);

    // Definir análise de risco
    $analiseRisco[] = 'O projeto apresenta riscos moderados, como possíveis atrasos devido a mudanças de requisitos ou problemas técnicos. Será necessário um acompanhamento constante para mitigar esses riscos.';

    // Exemplo de uso da função
    $analiseRisco[] = analiseDeRisco(
        'Problemas com fornecedor chave',
        'Média', // Pode ser 'Muito baixo', 'Baixo', 'Média', 'Alta' ou 'Muito alta'
        'Alta', // Pode ser 'Muito baixo', 'Baixo', 'Média', 'Alta' ou 'Muito alta'
        'Possibilidade de atrasos na entrega de insumos essenciais para o projeto.',
        'Mitigar', // Pode ser 'Prevenir', 'Mitigar', 'Transferir' ou 'Assumir'
        'Manter contato com outros fornecedores para ter alternativas, negociar prazos com o fornecedor atual.',
        'João Silva',
        '2023-08-15',
        'Pendente', // Pode ser 'OK', 'Pendente' ou 'Em andamento'
        'Aguardando resposta do fornecedor atual.'
    );

    $analiseRisco[] = analiseDeRisco(
        'Problemas com equipe reduzida',
        'Alta', // Pode ser 'Muito baixo', 'Baixo', 'Média', 'Alta' ou 'Muito alta'
        'Média', // Pode ser 'Muito baixo', 'Baixo', 'Média', 'Alta' ou 'Muito alta'
        'Possibilidade de atrasos na entrega devido à falta de recursos humanos suficientes.',
        'Mitigar', // Pode ser 'Prevenir', 'Mitigar', 'Transferir' ou 'Assumir'
        'Contratar profissionais temporários para períodos de maior demanda, reavaliar cronograma com equipe atual.',
        'Maria Santos',
        '2023-08-20',
        'Em andamento', // Pode ser 'OK', 'Pendente' ou 'Em andamento'
        'Entrevistas em andamento para a contratação de novos membros da equipe.'
    );
  
    // Definir análise SWOT
    $analiseSWOT[] = analiseSWOT(
        'Equipe experiente em desenvolvimento web, conhecimento sólido em tecnologias atuais',
        'Falta de experiência em desenvolvimento de projetos similares, equipe reduzida',
        'Mercado em crescimento para o tipo de projeto proposto, possibilidade de novas parcerias',
        'Concorrência acirrada, possíveis mudanças na legislação que afetem o projeto'
    );

    $resultado = array(
        "O custo para criação de $servico é de R$ $custoTotal",
        "O prazo de desenvolvimento é de $diasEstimados dias.",
        "O pagamento pode ser feito em 2 vezes sendo 50% no inicio e 50% na entrega do projeto.",
    );

    // Retornar os resultados em um array associativo
    // $resultado = array(
    //     'custoTotal' => $custoTotal,
    //     'prazoEstimado' => $diasEstimados,
    //     'prazoEtapas' => $prazoEtapas,
    //     'analiseRisco' => $analiseRisco,
    //     'analiseSWOT' => $analiseSWOT
    // );

    return $resultado;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar e processar os dados do formulário
    $salarioMensal =  trim(addslashes(filter_input(INPUT_POST, 'salarioMensal', FILTER_VALIDATE_FLOAT)));
    $horasEstimadas =  trim(addslashes(filter_input(INPUT_POST, 'horasEstimadas', FILTER_VALIDATE_FLOAT)));
    $valorHora =  trim(addslashes(filter_input(INPUT_POST, 'valorHora', FILTER_VALIDATE_FLOAT)));
    $tipoInfoproduto = trim(addslashes(filter_input(INPUT_POST, 'tipoInfoproduto', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY)));
    $servicosAdicionais = trim(addslashes(filter_input(INPUT_POST, 'servicosAdicionais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY)));

    $data['tipoProjeto'] = 'sistema'; // Pode ser 'site' ou 'sistema'
    $data['tamanhoProjeto'] = 5;
    $data['dominio'] = true;
    $data['hospedagem'] = false;
    $data['seguranca'] = false;
    $data['monitoramento'] = false;
    $data['emailPro'] = false;
    $data['identidadeVisual'] = false;
    $data['sistemaEntrega'] = false;
    $data['meioPagamento'] = false;
    $data['canaisComerciais'] = false;
    $data['automacaoAtendimento'] = false;
    $data['emailMarketing'] = false;
    $data['interacaoRedeSociais'] = false;
    $data['manutencao'] = 'trimestral';


    if ($salarioMensal !== false && $horasEstimadas !== false && $valorHora !== false) {
        // Criar uma instância da calculadora e da API Freelancer
        $calculadora = new CalculadoraFreelance($valorHora);
        $freelancerAPI = new FreelancerAPI($calculadora);

        // Configurar um novo valor de hora
        $freelancerAPI->setValorHora($valorHora);

        // Calcular o valor do projeto
        $valorProjeto = floatval($freelancerAPI->calcularValorProjeto($horasEstimadas));

        $validaCampos = validaCampos($tipoInfoproduto, $servicosAdicionais);

        // Exemplo de uso da função para calcular o orçamento
        $orcamento = calcularOrcamento($tipoInfoproduto, $servicosAdicionais);

        $orcamento = orcamentoDesenvolvimento($data);
        // print_r($orcamento);

        echo json_encode("Valor do projeto para $horasEstimadas horas estimadas R$: $valorProjeto");
        echo json_encode("O orçamento total é: R$" . number_format($orcamento['valorTotal'], 2, ',', '.') . " com prazo estimado de " . $orcamento['prazoEstimado'] . " dias.");
        exit;
    } else {
        echo json_encode("Erro nos dados fornecidos.");
        exit;
    }
}
?>

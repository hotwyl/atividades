<?php

function validaCampos($tipoInfoproduto, $servicosAdicionais){
    $error = [];

    if (!$tipoInfoproduto) {
        $error[] = "Falha identificada. Não foi identificado um valor válido para o campo Infoprodutos. O preenchimento do campo Infoprodutos é obrigatório.";
    }

    // if (!$servicosAdicionais) {
    //     $error[] = "Falha identificada. Não foi identificado um valor válido para o campo Serviços Adicionais. O preenchimento do campo Serviços Adicionais é obrigatório.";
    // }

    return $error;
}

function getOrcInfoProd($tipoInfoproduto, $valorTotal, $horasTotais, $maoDEobra){
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

function getServAdicional($servicosAdicionais, $valorTotal, $horasTotais, $maoDEobra){
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

// Função para calcular o orçamento com base nas categorias de infoprodutos e serviços
function calcularOrcamento($tipoInfoproduto, $servicosAdicionais){
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
    return array('valorTotal' => floatval($valorTotal), 'prazoEstimado' =>  intval($prazoEstimado));
}

// Exemplo de uso da função para calcular o orçamento de um curso online com 50 alunos, com duração de 20 horas e com serviços de marketing, suporte e design gráfico
$tipoInfoproduto = ['ebook']; // Pode ser 'ebook', 'webinar', 'palestra', 'aplicativo', 'consultoria', 'podcast', 'video_aulas', 'template_website', 'e_learning', 'coaching', 'curso_presencial', 'software', 'templates_graficos', 'workshop', 'aplicativo_mobile', 'arte_digital', 'curso_idiomas', 'e_commerce', 'web_design'
$servicosAdicionais = []; // Pode ser um array vazio caso não haja serviços adicionais

$validaCampos = validaCampos($tipoInfoproduto, $servicosAdicionais);

if(count($validaCampos)>0){
    echo json_encode($validaCampos); exit;
}

$orcamento = calcularOrcamento($tipoInfoproduto, $servicosAdicionais);

echo json_encode("O orçamento total para o infoproduto é: R$" . number_format($orcamento['valorTotal'], 2, ',', '.') . " com prazo estimado de " . $orcamento['prazoEstimado'] . " dias."); exit;

?>

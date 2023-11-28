<?php

try {
    $response['youtube_url_muvie'] = 'https://youtu.be/6mEx9FtuN0k?si=4puBgTQckt1_3Sh9';

    $validated = valida_dados($response);

    if (in_array($validated, [null, false])) {
        $validated = '';
        $response = formata_retorno('index', 'error');
    } elseif (in_array($validated, ['not_url', 'url_invalid'])) {
        $validated = '';
        $response = formata_retorno('index', 'error', $validated);
    } else {
        $response = formata_retorno('index', 'success', $validated);
    }

    // Transformando a resposta em JSON e retornando um código de status 200 (OK)
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($response);
} catch (\Exception $ex) {
    $response = formata_retorno('index', 'error', $ex->getMessage());

    // Transformando a resposta em JSON e retornando um código de status 401 (Unauthorized)
    header('Content-Type: application/json');
    http_response_code(401);
    echo json_encode($response);
}

function valida_dados($dados)
{
    if (!isset($dados['youtube_url_muvie']) || empty($dados['youtube_url_muvie']) || in_array($dados, [null, false])) {

        $dados = 'not_url';
    } else if (filter_var($dados['youtube_url_muvie'], FILTER_VALIDATE_URL) == FALSE) {

        $dados = 'url_invalid';
    } else {

        $valida_url = parse_url($dados['youtube_url_muvie']);

        if (in_array($valida_url['host'], ['www.youtube.com', 'youtu.be'])) {

            $dados = processa_info($dados['youtube_url_muvie']);
        } else {

            $dados = 'url_invalid';
        }
    }

    return $dados;
}

function formata_retorno($metodo, $resultado, $registros = null)
{
    switch ($resultado) {
        case 'success':
            $data['resultado'] = 'success';
            $data['messagem'] = retorna_mensagens($metodo, $registros);
            if (!($registros == null) || !($registros == false)) {
                $data['data'] = $registros;
            }
            break;

        case 'error':
            $data['resultado'] = 'error';
            $data['messagem'] = retorna_mensagens($metodo, $registros);
            if (!($registros == null) || !($registros == false)) {
                $data['data'] = $registros;
            }
            break;
    }

    return $data;
}

function retorna_mensagens($metodo, $registros)
{
    switch ($metodo) {
        case 'index':
            if ($registros == 'url_invalid') {
                $mensagem = 'Esta faltando algum parametro ou algum parametro informado é invalido.';
            } else if ($registros == 'not_url') {
                $mensagem = 'Método de busca não encontrada.';
            } else {
                $mensagem = 'Busca executada corretamente. Segue dados encontrados.';
            }
            break;

        default:
            $mensagem = '';
            break;
    }

    return  $mensagem;
}

function processa_info($url)
{
    $data = file_get_contents('https://www.youtube.com/oembed?format=json&url=' . $url);
    
    return json_decode($data, true);
}

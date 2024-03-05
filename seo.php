<?php

// Função para extrair métricas SEO básicas de um site
function extrairMetricasSEO($url) {
    
    // Valida URL
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return retorno("400", false, true, 'URL inválida', null);
    }

    // Extrai código do site
    $response = requstSite($url);

    // Tratamento de erro na requisição
    if (!$response) {
        return retorno("400", false, true, 'Falha ao obter a resposta do site', null);
    }

    // Extrair métricas SEO
    $return = [
        "url" => $url,
        "titulo" => extrairTitulo($response),
        "metaDescription" => extrairMetaDescription($response),
        "h1Tags" => extrairH1Tags($response),
        "numberOfImages" => contarImagens($response),
        "dnsInfo" => obterInformacoesDNS($url),
        "robotsTxt" => obterConteudoRobotsTxt($url),
    ];

    return retorno("200", true, false, 'Dados processados com sucesso.', $return);
}

function requstSite($url) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // $response = file_get_contents($url);

    return $response;
}

function extrairTitulo($html) {
    // Extrair o título da página
    preg_match('/<title>(.*?)<\/title>/', $html, $matches);
    return isset($matches[1]) ? $matches[1] : 'N/A';
}

function extrairMetaDescription($html) {
    // Extrair a meta descrição da página
    preg_match('/<meta\s+name="description"\s+content="(.*?)"\s*\/?>/', $html, $matches);
    return isset($matches[1]) ? $matches[1] : 'N/A';
}

function extrairH1Tags($html) {
    // Extrair as tags H1 da página
    preg_match_all('/<h1>(.*?)<\/h1>/', $html, $matches);
    return isset($matches[1]) ? implode(', ', $matches[1]) : 'N/A';
}

function contarImagens($html) {
    // Contar o número de tags de imagem na página
    preg_match_all('/<img\s+.*?>/i', $html, $matches);
    return isset($matches[0]) ? count($matches[0]) : 0;
}

function obterInformacoesDNS($url) {
    // Obter informações DNS
    $dnsInfo = dns_get_record($url);
    return $dnsInfo;
}

function obterConteudoRobotsTxt($url) {
    // Obter o conteúdo do arquivo robots.txt
    $robotsTxtUrl = $url . '/robots.txt';
    $robotsTxtContent = @file_get_contents($robotsTxtUrl);
    return $robotsTxtContent !== false ? $robotsTxtContent : 'N/A';
}

function retorno($code, $success = false, $error = false, $message = null, $content = null) {
    return json_encode([
      "code" => $code,
      "success" => $success,
      "error" => $error,
      "message" => $message,
      "content" => $content
    ], true);
}

// Exemplo de uso
$url = 'https://www.procob.com';
$dados = extrairMetricasSEO($url);
print_r($dados);

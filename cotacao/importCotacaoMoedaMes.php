<?php

/*

moedas

https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/Moedas?$top=100&$format=json&$select=simbolo,nomeFormatado,tipoMoeda

consulta por data / periodo

https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda='EUR'&@dataInicial='01-01-1999'&@dataFinalCotacao='01-20-1999'&$top=1000&$format=json&$select=paridadeCompra,paridadeVenda,cotacaoCompra,cotacaoVenda,dataHoraCotacao,tipoBoletim

*/


// Função para fazer requisição
function makeCurlRequest($url) {

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
    return $response;

}

// Função para buscar os tipos de moedas no endpoint
function getCurrencyTypes() {
    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/Moedas?$top=100&$format=json&$select=simbolo,nomeFormatado,tipoMoeda';
    $response = makeCurlRequest($url);
    return json_decode($response, true);
}

// Função para consultar a última data salva em um JSON local
function getLastSavedDate() {
    $filename = "cotacoes.json";
    if (file_exists($filename)) {
        $data = json_decode(file_get_contents($filename), true);
        if (isset($data['last_saved_date'])) {
            return $data['last_saved_date'];
        }
    }
    return null;
}

// Função para consultar a cotação do próximo mês para cada moeda listada
function getCurrencyRatesNextMonth($currency, $startDate, $endDate) {
    
    $url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda='$currency'&@dataInicial='$startDate'&@dataFinalCotacao='$endDate'&\$top=1000&\$format=json&\$select=paridadeCompra,paridadeVenda,cotacaoCompra,cotacaoVenda,dataHoraCotacao,tipoBoletim";

    $response = makeCurlRequest($url);

    return json_decode($response, true);
}

// Função para retornar range de data
function getFirstAndLastDayOfMonth($dateStr) {
    $date = DateTime::createFromFormat('m-d-Y', $dateStr);
    $today = new DateTime();
    $minDt = DateTime::createFromFormat('m-d-Y', "12-31-1998");

    // Obtém o ano e o mês da data informada
    $year = intval($date->format('Y'));
    $month = intval($date->format('m'));

    // Obtém o ano e o mês da data atual
    $currentYear = intval($today->format('Y'));
    $currentMonth = intval($today->format('m'));

    if ($date > $today) {
        return 'A data informada é superior a data atual';
    }

    if ($date < $minDt) {
        return 'A data informada é inferior a data minima';
    }

    if ($year > $currentYear) {
        return 'A data informada possui um ano maior que o ano atual.';
    }
    
    if ($year >= $currentYear && $month > $currentMonth) {
        return 'A data informada possui um mês maior que o mês atual.';
    } 

    // Incrementa a data informada em um dia para obter a data inicial
    $startDate = clone $date;
    $startDate->modify('+1 day');

    // Se a data inicial for o primeiro dia do mês atual, a data final será a data atual
    if ($startDate->format('Y-m') === $today->format('Y-m')) {
        $endDate = $today;
    } else {
        // Define o último dia do mês para a data inicial
        $endDate = clone $startDate;
        $endDate->modify('last day of this month');
    }

    return [
        'start_date' => $startDate->format('m-d-Y'),
        'end_date' => $endDate->format('m-d-Y'),
    ];
}

// Função para salvar os dados em um arquivo JSON local
function saveToJson($data, $endDate) {
    $filename = "cotacoes.json";
    $data['last_saved_date'] = $endDate; // Salva a data atual como a última data salva

    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

$lastSavedDate = getLastSavedDate();

if (!$lastSavedDate) {

    $lastSavedDate = date('12-31-1998'); // Se não houver data salva, assumimos a data atual como ponto de partida.

} 

$date = getFirstAndLastDayOfMonth($lastSavedDate);

$startDate = $date["start_date"];
$endDate = $date["end_date"];

$currencyTypes = getCurrencyTypes();

foreach ($currencyTypes['value'] as $currency) {
    $symbol = $currency['simbolo'];
    $ratesNextMonth = getCurrencyRatesNextMonth($symbol, $startDate, $endDate);

    $arrRates[$currency['simbolo']] = $ratesNextMonth;
}

saveToJson($arrRates, $endDate);

echo "Cotações da data $startDate até $endDate salvos no arquivo cotacoes.json";

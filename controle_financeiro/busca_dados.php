<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('default_charset', 'UTF-8');
// header('Content-Type: application/json; charset=utf-8');
// header('Accept: application/json; charset=utf-8');
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['data_inicio'],$_POST['data_fim'])) {

    foreach ($_POST as $key => $param) {
        $post[$key] = addslashes(trim($param));
    }

    $condicoes = "1+1";

    if(isset($post['nome_funcionario']) && !empty($post['nome_funcionario'])){
        $condicoes .= " AND nomeFuncionario LIKE '%".$post['nome_funcionario']."%'";
    }

    if(isset($post['data_inicio']) && !empty($post['data_inicio'])){
        $condicoes .= " AND dataReferencia >= '".$post['data_inicio']."'";
    }

    if(isset($post['data_fim']) && !empty($post['data_fim'])){
        $condicoes .= " AND dataReferencia <= '".$post['data_fim']."'";
    }

    if(isset($post['excede_intervalo']) && !empty($post['excede_intervalo'])){
        $condicoes .= " AND duracaoIntervalo > '00:10:59'";
    }

    $condicoes .= " ORDER BY nomeFuncionario, dataReferencia, id, duracaoIntervalo ASC";

    abreConexao253('ecocontrole');

    $select = "SELECT * FROM econetfin.funcionario_registro_catraca_tb WHERE ".$condicoes;

    $select_query = mysql_query($select);

    if (mysql_num_rows($select_query) > 0) {
        while ($reg = mysql_fetch_assoc($select_query)) {
            $arRegistros[] = $reg;
        }
    }

    // _debug($arRegistros);

    // $response['result'] = 'success';
    // $response['message'] = 'Busca de dados realizada com sucesso.';
    // $response['data'] = $arRegistros;
    // echo json_encode($response, JSON_FORCE_OBJECT);

} 
// else {
//     $response['result'] = 'error';
//     $response['message'] = 'Data de Inicio e Fim devem ser informadas.';
//     $response['data'] = null;
//     echo json_encode($response, JSON_FORCE_OBJECT);
//     exit;
// }
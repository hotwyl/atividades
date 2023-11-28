<?php
require_once "../../vendor/autoload.php";

use Api\Classes\InputRequest;
use Api\Classes\Marca;
use Api\Classes\Retorno;


$inputsGet = InputRequest::inputsGet();

if($inputsGet->key && $inputsGet->protocolo && $inputsGet->method === 'get'){
    try {    
        // $sql = $pdo->query("SELECT * FROM marca WHERE key = :key AND protocolo = :protocolo");
        // $sql->bindValue(':key', $key);
        // $sql->bindValue(':protocolo', $protocolo);
        // $sql->execute();

        // if($sql->rowCount() > 0){
        //     $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        //     foreach ($data as $item) {
        //         $array['resultado'][] = $item;
        //     }
        // } else {
        //     $array = null;
        // }

        $array = 'teste';

        echo Retorno::success($array);
        exit;
    } catch (\Throwable $th) {
        echo Retorno::error($th);
        exit;
    }
} else {
    $error = 'URL Inválida';
    echo Retorno::error($error);
    exit;
}

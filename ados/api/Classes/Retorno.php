<?php

namespace Api\Classes;

class Retorno
{

    static function success($array){

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
        header("Content-Type: Application/json");

        return  json_encode([
            "sucesso" => 'SIM',
            "message" => 'Ação realizada com sucesso',
            "content" => $array,
        ]);
    }

    static function error($array){

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
        header("Content-Type: Application/json");

        return  json_encode([
            "sucesso" => 'NÃO',
            "message" => 'Ação não realizada',
            "erros" => $array
        ]);
    }
}
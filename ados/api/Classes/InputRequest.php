<?php

namespace Api\Classes;

use stdClass;

class InputRequest
{
    static function inputsGet()
    {
        $params = new stdClass();

        $params->method = (strtolower($_SERVER['REQUEST_METHOD'])) ?? false;
        $params->key = (filter_input(INPUT_GET, 'k')) ?? false;
        $params->protocolo = (filter_input(INPUT_GET, 'p')) ?? false;

        $headers = apache_request_headers();
        if ($headers['token']) {
        //     //token = base64 [ $key:$protocolo:codigoEmpresa: ]
            $arr = explode(':', base64_decode($headers['token']));
            $params->tokenKey = ($arr[0]) ?? false;
            $params->tokenProtocolo = ($arr[1]) ?? false;
            $params->tokenCodigoEmpresa = ($arr[2]) ?? false;
        }
        
        return $params;
    }
}
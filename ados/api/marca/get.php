<?php
require_once "../../vendor/autoload.php";

use Api\Classes\Marca;
use Api\Classes\Retorno;

try {
    $return = [];
    $marca = new Marca('teste', 'var');

    $return = [
        "nome" => $marca->getNome()
    ];

    echo Retorno::success($return);
    exit;

} catch (\Throwable $th) {
    // throw $th;
    echo Retorno::error($th);
}
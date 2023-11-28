<?php
require_once "../vendor/autoload.php";

use App\Classes\Marca;
use App\Classes\Retorno;

try {
    $return = [];
    $marca = new Marca('teste', 'var');

    $return = [
        "nome" => $marca->getNome()
    ];

    echo Retorno::success($return);

} catch (\Throwable $th) {
    throw $th;
}


// {
//     "marca": {
//         "nome": "",
//         "descricao": "",
//         "pesquisa": {
//             "key_words": {},
//             "personas": {},
//             "referencias": {},
//             "ideias": {}
//         },
//         "business_plan": {},
//         "canvas": {},
//         "jornada": {},
//         "identidade": {},
//         "midia_kit": {},
    
//     "produtos_servicos": {
//         "ebook": {},
//         "webnar": {},
//         "master_class": {},
//         "curso": {},
//         "mentoria": {},
//         "assessoria": {}
//     },
//     "publicidade": {
//         "facebook": {},
//         "instagram": {},
//         "youtube": {},
//         "site": {}
//     }
// }
// }

// "funil": {},
// "copy": {},
// "vsl": {},
// "hedline": {},
// "mail": {},
// "posts": {},
// "google_ads": {},
// "facebook_ads": {} 
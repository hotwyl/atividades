<?php
$url = 'https://www.example.com/teste';

$teste['url'] = validate_url($url);
$teste['uri'] = ($teste['url']) ? testaUrlToUri($url) : false;

var_dump($teste);

function testaUrlToUri($url){

    if(substr($url, -1) == '/'){
        $url = substr($url, 0, -1);
    }

    // if(substr($url, 0, 4) != 'http' && substr($url, 0, 3) != 'www' && substr($url, 0, 2) != '//'){
    //     $url = "//" . $url;
    // }

    if(parse_url($url, PHP_URL_HOST)) {

        $u = parse_url($url);

        if(!empty(trim($u['host'])) && isset($u['path']) && !empty(trim($u['path']))  ){
            return true;
        }
    }

    return false;
}

function validate_url($url) {

    $url = filter_var($url, FILTER_SANITIZE_URL);

    if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url)){        
        $path = parse_url($url, PHP_URL_PATH);
        $encoded_path = array_map('urlencode', explode('/', $path));
        $url = str_replace($path, implode('/', $encoded_path), $url);

        // $teste1 =  filter_var($url, FILTER_VALIDATE_URL) ? true : false;

        if(filter_var($url, FILTER_VALIDATE_URL)){
            $u = parse_url($url);

            $testUrl = $u;
            unset($testUrl['host']); 
            unset($testUrl['scheme']);
            unset($testUrl['path']);
            unset($testUrl['query']);

            if(isset($u['host']) && parse_url($url, PHP_URL_HOST) != null && !count($testUrl) && filter_var('http://'.$u['host'], FILTER_VALIDATE_URL) !== false){
                return true;
            }
        }

    }

    return false;
}
?>
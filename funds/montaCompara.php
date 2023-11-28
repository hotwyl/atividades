<?php

// $apt = [
// '0,1,3,4,6,12,16,17,19,20,23,24,26,27,29,31,35,37,38,41,42,43,44,45,47,48,49,53,54,61,64,66,68,72,73,76,78,79,82,83,85,86,91,92,93,99',
// ];

$sort = [
    '2471 - 00,03,05,14,25,26,35,37,38,39,51,65,69,73,75,77,79,84,90,98',
    '2470 - 00,04,06,14,23,25,33,37,42,49,53,56,60,61,62,69,84,91,96,97',
];

// sorteio($sort);

function aposta($apt){
    foreach ($apt as $val) {
        $str = explode(',',$val);
        $nStr=[];
        foreach ($str as $key => $value) {
            $nStr[] = (strlen(trim($value))==1) ? '0'.trim($value) : trim($value);
        }
    
        $newStr[] = [implode(',', $nStr)];
        
    }
    
    $codificado = json_encode($newStr);
    
    file_put_contents('novo.json', $codificado);

}

function sorteio($sort){
    foreach ($sort as $val) {
        $arr = explode('-',$val);
        $str = explode(',',$arr[1]);
        $nStr=[];
        foreach ($str as $key => $value) {
            $nStr[] = (strlen(trim($value))==1) ? '0'.trim($value) : trim($value);
        }
                
        $newStr[trim($arr[0])] = array(
            "numero_sorteio" => trim($arr[0]),
            "bolas_sorteadas" => trim(implode(',', $nStr))
        );
        
    }
    
    $codificado = json_encode($newStr);
    
    file_put_contents('novo.json', $codificado);

}

<?php

function calcular($a, $b)
{

    $num1 = valida_float($a);
    $num2 = valida_float($b);

    $resultado = array(
        'somar' => somar($num1, $num2),
        'subtrair' => subtrair($num1, $num2),
        'multiplicar' => multiplicar($num1, $num2),
        'dividir' => dividir($num1, $num2)
    );

    return $resultado;
    exit;
}

function somar($num1, $num2)
{
    $calculo1 = $num1 + $num2;
    $calculo2 = $num2 + $num1;
    return "
    O resultado da <u>SOMA</u> de <i>" . $num1 . " + " . $num2 . "</i> é: <b>" . $calculo1 . "</b><br>
    O resultado da <u>SOMA</u> de <i>" . $num2 . " + " . $num1 . "</i> é: <b>" . $calculo2 . "</b>
    ";
    exit;
}

function subtrair($num1, $num2)
{
    $calculo1 = $num1 - $num2;
    $calculo2 = $num2 - $num1;
    return "
    O resultado da <u>SUBTRAÇÃO</u> de <i>" . $num1 . " - " . $num2 . "</i> é: <b>" . $calculo1 . "</b><br>
    O resultado da <u>SUBTRAÇÃO</u> de <i>" . $num2 . " - " . $num1 . "</i> é: <b>" . $calculo2 . "</b>
    ";
    exit;
}

function multiplicar($num1, $num2)
{
    $calculo1 = $num1 * $num2;
    $calculo2 = $num2 * $num1;
    return "
    O resultado da <u>MULTIPLICAÇÃO</u> de <i>" . $num1 . " * " . $num2 . "</i> é: <b>" . $calculo1 . "</b><br>
    O resultado da <u>MULTIPLICAÇÃO</u> de <i>" . $num2 . " * " . $num1 . "</i> é: <b>" . $calculo2 . "</b>
    ";
    exit;
}

function dividir($num1, $num2)
{
    $calculo1 = $num1 / $num2;
    $calculo2 = $num2 / $num1;
    return "
    O resultado da <u>DIVISÃO</u> de <i>" . $num1 . " / " . $num2 . "</i> é: <b>" . $calculo1 . "</b><br>
    O resultado da <u>DIVISÃO</u> de <i>" . $num2 . " / " . $num1 . "</i> é: <b>" . $calculo2 . "</b>
    ";
    exit;
}

function valida_float($dados)
{
    return floatval(str_replace(',', '.', $dados));
    exit;
}

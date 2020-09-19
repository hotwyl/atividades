<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title>Teste Calculadora</title>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection" />

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

	<?php

		function calcular($a, $b)
		{

			$num1 = $a;
			$num2 = $b;

			$resultado = array(
				'somar' => somar($num1, $num2),
				'subtrair' => subtrair($num1, $num2),
				'multiplicar' => multiplicar($num1, $num2),
				'dividir' => dividir($num1, $num2)
			);

			return $resultado;
		}

		function somar($num1, $num2)
		{
			$calculo1 = $num1 + $num2;
			$calculo2 = $num2 + $num1;
			return "
			O resultado da <u>SOMA</u> de <i>".$num1." + ".$num2."</i> é: <b>" . $calculo1 . "</b><br>
			O resultado da <u>SOMA</u> de <i>".$num2." + ".$num1."</i> é: <b>" . $calculo2. "</b>
			";
		}

		function subtrair($num1, $num2)
		{
			$calculo1 = $num1 - $num2;
			$calculo2 = $num2 - $num1;
			return "
			O resultado da <u>SUBTRAÇÃO</u> de <i>".$num1." - ".$num2."</i> é: <b>" . $calculo1 . "</b><br>
			O resultado da <u>SUBTRAÇÃO</u> de <i>".$num2." - ".$num1."</i> é: <b>" . $calculo2. "</b>
			";
		}

		function multiplicar($num1, $num2)
		{
			$calculo1 = $num1 * $num2;
			$calculo2 = $num2 * $num1;
			return "
			O resultado da <u>MULTIPLICAÇÃO</u> de <i>".$num1." * ".$num2."</i> é: <b>" . $calculo1 . "</b><br>
			O resultado da <u>MULTIPLICAÇÃO</u> de <i>".$num2." * ".$num1."</i> é: <b>" . $calculo2. "</b>
			";
		}

		function dividir($num1, $num2)
		{
			$calculo1 = $num1 / $num2;
			$calculo2 = $num2 / $num1;
			return "
			O resultado da <u>DIVISÃO</u> de <i>".$num1." / ".$num2."</i> é: <b>" . $calculo1 . "</b><br>
			O resultado da <u>DIVISÃO</u> de <i>".$num2." / ".$num1."</i> é: <b>" . $calculo2. "</b>
			";
		}


	if (isset($_POST["numero1"]) && !empty($_POST["numero1"]) && isset($_POST["numero2"]) && !empty($_POST["numero2"])) {
		$variavel = calcular($_POST["numero1"], $_POST["numero2"]);
		//unset($_POST);
	?>
		<center>
			<div class="card" style="width: 500px">
				<p> &nbsp;</p>
				<p><span class="card-title">Resultado</span></p>
				<p> <label> <?php print_r($variavel["somar"]); ?></label> </p>
				<p> <label> <?php print_r($variavel["subtrair"]); ?></label> </p>
				<p> <label> <?php print_r($variavel["multiplicar"]); ?></label> </p>
				<p> <label> <?php print_r($variavel["dividir"]); ?></label> </p>
				<p> <label> <a class="waves-effect waves-light btn-small" href="/">VOLTAR</a> </label> </p>
				<p><br></p>
			</div>
		</center>

	<?php
	} else { ?>

		<center>
			<div class="card" style="width: 350px">
				<p><br></p>
				<form method="POST" style="width: 305px">
					<p>
						<span class="card-title">CALCULAR</span>
						<hr width="150px">
					</p><br>

					<p>Informe o PRIMEIRO valor a ser calculado:<input type="number" id="numero1" name="numero1" value="" placeholder="Digite aqui o Primeiro valor para calcular" required></p>
					<p>Informe o SEGUNDO valor a ser calculado:<input type="number" id="numero2" name="numero2" value="" placeholder="Digite aqui o Segundo valor para calcular" required></p><br>
					<p><input class="waves-effect waves-light btn-small" type="submit" value="Calcular"></p>
				</form>
				<p><br></p>
			</div>
		</center>

	<?php } ?>

	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
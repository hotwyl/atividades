@extends('calculadora.layout')

@section('content')

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
		<header class="masthead mb-auto text-center"> 
			<div class="textt-center">
				<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
					<a class="navbar-brand" href="#">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calculator" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M12 1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
					<path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
					</svg>  Calculadora Básica
					</a>
				</nav>
			</div>
		</header>

		<main role="main" class="inner container py-3">
			<section class="jumbotron container py-3" style="width: 555px">
			<center><p><h1><span class="badge badge-pill badge-secondary"> &nbsp; Resultado &nbsp; </span></h1></p></center>
				<div class="alert alert-info" role="alert">
					<?php print_r($variavel["somar"]); ?>
					<hr>
					<?php print_r($variavel["subtrair"]); ?>
					<hr>
					<?php print_r($variavel["multiplicar"]); ?>
					<hr>
					<?php print_r($variavel["dividir"]); ?>
				</div>
				<a class="btn btn-secondary btn-sm btn-block" href="calculadora-bootstrap.php">VOLTAR</a>
			</section>
		</main>

		

	<?php
	} else { ?>
		<header class="masthead mb-auto"> 
			<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
				<a class="navbar-brand" href="#">
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calculator" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M12 1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
				<path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
				</svg>  Calculadora Básica
				</a>
			</nav>
		</header>

		<main role="main" class="inner container py-5">
			<section class="card container py-3 px-5"> 
				<form class="form-signin text-center container" method="POST">
					<div class="form-group">
					<svg width="10em" height="10em" viewBox="0 0 16 16" class="bi bi-calculator-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z"/>
					</svg>
						<p class="h5 mb-3 font-weight-normal py-1">Preencha os campos solicitados à baixo para efetuar o devido calculo.</p>
						<hr width="75%">
					</div>

					<div class="form-group row py-1">
						<label for="numero1">Informe o PRIMEIRO valor a ser calculado: &nbsp;&nbsp;</label>
						<input type="number" id="numero1" name="numero1" class="form-control col-sm" value="" placeholder="Digite aqui o Primeiro valor para calcular" required>
					</div>

					<div class="form-group row py-1">
						<label for="numero2">Informe o SEGUNDO valor a ser calculado: &nbsp;</label>
						<input type="number" id="numero2" name="numero2" class="form-control col-sm" value="" placeholder="Digite aqui o Segundo valor para calcular" required>
					</div>

					<div class="form-group row py-1">
						<button class="btn btn-lg btn-primary btn-block" type="submit">Calcular</button>
					</div>
				</form>
			</section>
		</main>

		<footer class="mastfoot mt-auto bg-light">
			<div class="container inner">
				<center> <span class="text-muted">&copy;HOTWYL | WILLFROMBRASIL </span> </center>
			</div> 
		</footer>


	<?php } ?>
@endsection

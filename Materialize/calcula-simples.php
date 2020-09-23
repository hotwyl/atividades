<?php

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
				<p> <label> <a class="waves-effect waves-light btn-small" href="index.php">VOLTAR</a> </label> </p>
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
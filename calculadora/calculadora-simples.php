<?php

if (isset($_POST["numero1"]) && !empty($_POST["numero1"]) && isset($_POST["numero2"]) && !empty($_POST["numero2"])) {
    $variavel = calcular(addslashes($_POST["numero1"]), addslashes($_POST["numero2"]));
?>
    <section class="jumbotron container card py-3 px-5" style="width: 555px">
            <p class="h4 text-center"> <span class="badge bg-secondary" style="width: 100%;"> &nbsp; Resultado &nbsp; </span> </p>
        <div class="alert alert-secondary py-3" role="alert">
            <?php print_r($variavel["somar"]); ?>
            <hr>
            <?php print_r($variavel["subtrair"]); ?>
            <hr>
            <?php print_r($variavel["multiplicar"]); ?>
            <hr>
            <?php print_r($variavel["dividir"]); ?>
        </div>
        <a class="btn btn-secondary btn-sm btn-block" href="index.php">VOLTAR</a>
    </section>

<?php
} else { ?>
    <section class="card container p-5" style="width: 75%">
        <form class="form-signin text-center container" method="POST" autocomplete="off">
            <div class="form-group">
                <svg width="10em" height="10em" viewBox="0 0 16 16" class="bi bi-calculator-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z" />
                </svg>
                <p class="h5 mb-3 font-weight-normal py-1">Preencha os campos solicitados à baixo para efetuar o devido calculo.</p>
                <hr width="100% ">
            </div>
        
            <div class="form-group row py-3">
                <div class="col-12 col-sm-6"><label for="numero1">Informe o PRIMEIRO valor a ser calculado: &nbsp;&nbsp;</label></div>
                <div class="col-12 col-sm-6"><input type="number" id="numero1" name="numero1" class="form-control col-sm" value="" placeholder="Digite aqui o Primeiro valor para calcular" required></div>
            </div>

            <div class="form-group row py-3">
                <div class="col-12 col-sm-6"><label for="numero2">Informe o SEGUNDO valor a ser calculado: &nbsp;</label></div>
                <div class="col-12 col-sm-6"><input type="number" id="numero2" name="numero2" class="form-control col-sm" value="" placeholder="Digite aqui o Segundo valor para calcular" required></div>
            </div>

            <div class="form-group row py-1">
                <button class="btn btn-lg btn-secondary btn-block" type="submit">Calcular</button>
            </div>
        </form>
    </section>

<?php } ?>
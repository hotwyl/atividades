<?php 
include_once 'variaveis.php';

session_start();

if(!in_array($_SESSION['Cadastro_Usuario_Codigo'],$permitidos)){
    echo "<script type='text/javascript'> alert('Acesso Restrito.'); </script>";
    echo "<center> Acesso Restrito. </center>";
    exit;
}

?>

<!doctype html>
    <html lang="pt_br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Registros Cartraca</title>
    </head>

    <body class="container py-5">

        <header></header>

        <main class="container py-5">

            <form action="importar_planilha.php" class="g-3 g-3 needs-validation" method="POST" enctype="multipart/form-data" autocomplete="off">

                <fieldset class="form-group">

                 <div class="row">

                    <legend class="text-center pb-5">Importar registro da catraca do refeitório</legend>

                    <div class="col-md-4">
                        <label for="file" class="form-label">Planilha Anexo</label>
                        <input type="file" class="form-control" name="file" id="file" accept=".xls, .xlsx" required>
                    </div>

                    <div class="col-md-4">
                        <label for="data_inicio" class="form-label">Data Inicio</label>
                        <input type="date" class="form-control" name="data_inicio" id="data_inicio" value="Mark" required>
                    </div>

                    <div class="col-md-4">
                        <label for="data_fim" class="form-label">Data Fim</label>
                        <input type="date" class="form-control" name="data_fim" id="data_fim" required>
                    </div>

                    <div class="col-md-3">
                        <label for="hr_inicio_almoco" class="form-label">Inicio Expediente</label>
                        <input type="time" class="form-control" name="hr_inicio_almoco" id="hr_inicio_almoco" required>
                    </div>

                    <div class="col-md-3">
                        <label for="hr_inicio_expediente" class="form-label">Saida Almoço</label>
                        <input type="time" class="form-control" name="hr_inicio_expediente" id="hr_inicio_expediente" required>
                    </div>

                    <div class="col-md-3">
                        <label for="hr_fim_almoco" class="form-label">Retorno Almoço</label>
                        <input type="time" class="form-control" name="hr_fim_almoco" id="hr_fim_almoco" required>
                    </div>

                    <div class="col-md-3">
                        <label for="hr_fim_expediente" class="form-label">Fim Expediente</label>
                        <input type="time" class="form-control" name="hr_fim_expediente" id="hr_fim_expediente" required>
                    </div>

                    <div class="col-12 mt-5 d-flex justify-content-between">
                        <a href="index.php"><button type="button" class="btn btn-outline-danger btn-sm px-5"><i class="fas fa-arrow-circle-left"></i> Voltar</button></a>
                        <button class="btn btn-outline-primary btn-sm px-5" type="submit"><i class="fas fa-upload"></i> Importar</button>
                    </div>

                </div>

            </fieldset>

        </form>

    </main>

    <footer></footer>


    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
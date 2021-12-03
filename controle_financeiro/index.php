<?php 

include_once 'busca_dados.php';
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

        <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Registros Cartraca</title>

        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable( {
                    "paging":   false,
                    "ordering": true,
                    "info":     false,
                    "bFilter": false
                } );
            } );
      </script>

  </head>

  <body class="container py-3">

    <header>

        <?php if($_GET['import']=='success'){ echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Dados importado com Sucesso. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";} ?>


        <form method="POST" autocomplete="off">

            <div class=" mb-3">
                <center>
                    <a href="add.php" class="btn btn-outline-secondary btn-sm px-5 rounded"><i class="fas fa-file-upload"></i> Importar Planilha</a>
                </center>
            </div>


            <div class="input-group">

                <span class="input-group-text">Nome</span>
                <input type="text" class="form-control" name="nome_funcionario">

                <span class="input-group-text">Inicio</span>
                <input type="date" class="form-control" name="data_inicio" required>

                <span class="input-group-text">Fim</span>
                <input type="date" class="form-control" name="data_fim" required>

                <input type="text" class="form-control" aria-label="Text input with checkbox" value="Excede Intervalo" disabled readonly>
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" name="excede_intervalo" aria-label="Checkbox for following text input">
                </div>      

                <button type="submit" class="btn btn-outline-secondary btn-sm ms-3 rounded"><i class="fas fa-search"></i> Filtrar Informações</button>

            </div>

        </form>

    </header>

    <main class="py-3">

        <table class="table table-striped table-bordered table-hover display" id="example">

            <?php

            if($arRegistros){

                echo "
                <thead>
                <tr>
                <th>Funcionário</th>
                <th>Data</th>
                <th>Entrada</th>
                <th>Saida</th>
                <th>Duração</th>
                </tr>
                </thead>

                <tbody>
                ";

                foreach ($arRegistros as $value) {

                    $color = $value['duracaoIntervalo'] > "00:10:59" ? "style='color:red';":'';

                    echo " <tr> 
                    <td>".$value['nomeFuncionario']."</td> 
                    <td>".date('d/m/Y', strtotime($value['dataReferencia']))."</td> 
                    <td>".date('H:i', strtotime($value['horarioEntrada']))."</td> 
                    <td>".date('H:i', strtotime($value['horarioSaida']))."</td> 
                    <td $color>".date('H:i', strtotime($value['duracaoIntervalo']))."</td>
                    </tr> ";

                }

                echo "
                </tbody>

                <tfoot>
                <tr>
                <th>Funcionário</th>
                <th>Data</th>
                <th>Entrada</th>
                <th>Saida</th>
                <th>Duração</th>
                </tr>
                </tfoot>
                ";


            }else{

                echo "

                <thead>

                </thead>

                <tbody>

                <tr> <td class='text-center'> Selecione os dados a serem exibibidos nos filtros acima. </td> </tr>

                </tbody>

                <tfoot>

                </tfoot>

                ";

            }

            ?>

        </table>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
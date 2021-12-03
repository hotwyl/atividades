 <head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('default_charset', 'UTF-8');
// header('Content-Type: application/json; charset=utf-8');
// header('Accept: application/json; charset=utf-8');
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'], $_POST['data_inicio'],$_POST['data_fim'],$_POST['hr_inicio_expediente'],$_POST['hr_inicio_almoco'],$_POST['hr_fim_almoco'],$_POST['hr_fim_expediente']) && !empty($_FILES['file'])) {

    foreach ($_POST as $key => $param) {
        $post[$key] = addslashes(trim($param));
    }

    $arquivo = $_FILES['file'];
    $data_inicio = $post['data_inicio'];
    $data_fim = $post['data_fim'];
    $hr_inicio_expediente = date('H:i:s', strtotime($post['hr_inicio_expediente']));
    $hr_inicio_almoco = date('H:i:s', strtotime($post['hr_inicio_almoco']));
    $hr_fim_almoco = date('H:i:s', strtotime($post['hr_fim_almoco']));
    $hr_fim_expediente = date('H:i:s', strtotime($post['hr_fim_expediente']));

    $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

    if ($ext === 'xls' || $ext === 'xlsx') {
        require_once 'Excel/PHPExcel/IOFactory.php';
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        $inputFile = $arquivo["tmp_name"];

        $inputFileType = PHPExcel_IOFactory::identify($inputFile);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFile);

        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();

        $sheetNomes = $objPHPExcel->getSheetNames();
        $contador = false;
        
        foreach($sheetNomes as $key => $tabela){
            $sheet = $objPHPExcel->getSheetByName($tabela);       
            $highestRow = $sheet->getHighestRow(); 
            $highestColumn = $sheet->getHighestColumn();

            $nome_colunas = $sheet->rangeToArray('A1:'.$highestColumn.'1',' ', FALSE, FALSE);

            $nome_colunas = (implode(",",$nome_colunas[0]));
            for ($row = 2; $row <= $highestRow; $row++){ 

                $dado = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, ' ', FALSE, FALSE);

                $arDados[$dado[$row-1][0]][$dado[$row-1][1]][$dado[$row-1][3]][] = $dado[$row-1][2];

                $data_compara = implode('-', array_reverse(explode('/', $dado[$row-1][1])));

                if($data_compara >= $data_inicio && $data_compara <= $data_fim){

                    if(count($arDados[$dado[$row-1][0]][$dado[$row-1][1]])>1){

                        $contador = count($arDados[$dado[$row-1][0]][$dado[$row-1][1]]['Entrada']);
                        $entrada = null;
                        $saida = null;

                        for ($cont=0; $cont < $contador; $cont++) { 

                            $arDif = $arDados[$dado[$row-1][0]][$dado[$row-1][1]];
                            $entrada = date('H:i:s', strtotime($arDif['Entrada'][$cont]));
                            $saida = date('H:i:s', strtotime($arDif['Saída'][$cont]));

                            if( $entrada > $hr_inicio_expediente && $entrada < $hr_inicio_almoco ||
                                $entrada > $hr_fim_almoco && $entrada < $hr_fim_expediente ||
                                $saida > $hr_inicio_expediente && $saida < $hr_inicio_almoco ||
                                $saida > $hr_fim_almoco && $saida < $hr_fim_expediente ){

                                $hora1 = explode(":",$entrada);
                                $hora2 = explode(":",$saida);
                                $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
                                $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
                                $resultado = $acumulador2 - $acumulador1;
                                $hora_ponto = floor($resultado / 3600);
                                $resultado = $resultado - ($hora_ponto * 3600);
                                $min_ponto = floor($resultado / 60);
                                $resultado = $resultado - ($min_ponto * 60);
                                $secs_ponto = $resultado;

                                $tempo = date('H:i:s', strtotime($hora_ponto.":".$min_ponto.":".$secs_ponto));

                                $arDados[$dado[$row-1][0]][$dado[$row-1][1]][$cont]['nome'] = $dado[$row-1][0];

                                $arDados[$dado[$row-1][0]][$dado[$row-1][1]][$cont]['data'] = implode('-', array_reverse(explode('/', $dado[$row-1][1])));

                                $arDados[$dado[$row-1][0]][$dado[$row-1][1]][$cont]['Entrada'] = $entrada;

                                $arDados[$dado[$row-1][0]][$dado[$row-1][1]][$cont]['Saída'] = $saida;

                                $arDados[$dado[$row-1][0]][$dado[$row-1][1]][$cont]['duracao'] = $tempo;

                            }
                            
                        }

                        $contador = 0;

                    }

                }

            } 

            // _debug($arDados);
            $j = 0;
            foreach ($arDados as $nome) {
                // _debug($nome);
                $i = 0;
                foreach ($nome as $data) {

                    // _debug($data[0]);

                    $position = count($data)-2;

                    for ($k=0; $k < $position; $k++) { 

                        if(isset($data[$k]['nome'],$data[$k]['data'],$data[$k]['Entrada'],$data[$k]['Saída'],$data[$k]['duracao'])){
                            $otherDado[$j][$i]['nome'] = $data[$k]['nome'];
                            $otherDado[$j][$i]['data'] = $data[$k]['data'];
                            $otherDado[$j][$i]['entrada'] = $data[$k]['Entrada'];
                            $otherDado[$j][$i]['saida'] = $data[$k]['Saída'];
                            $otherDado[$j][$i]['duracao'] = $data[$k]['duracao'];

                            $values[] = "(
                            '".$data[$k]['nome']."',
                            '".$data[$k]['data']."',
                            '".$data[$k]['Entrada']."',
                            '".$data[$k]['Saída']."',
                            '".$data[$k]['duracao']."'
                        )";

                    }
                    $i++;

                }
            }
            $j++;   
        }

        abreConexao253('ecocontrole');

        $select = "SELECT * FROM econetfin.funcionario_registro_catraca_tb WHERE dataReferencia >= '".$data_inicio."' AND dataReferencia <= '".$post['data_fim']."' ORDER BY nomeFuncionario, dataReferencia ASC";
        $select_query = mysql_query($select);

        if($select_query){
            $delete = "DELETE FROM econetfin.funcionario_registro_catraca_tb WHERE dataReferencia >= '".$data_inicio."' AND dataReferencia <= '".$post['data_fim']."'";
            $delete_query = mysql_query($delete);
        }

        $select_query = mysql_query($select);
        
        $insert = "INSERT INTO econetfin.funcionario_registro_catraca_tb 
        (nomeFuncionario, dataReferencia, horarioEntrada, horarioSaida, duracaoIntervalo) VALUES 
        ".implode(",",$values);
        $sql_query = mysql_query($insert);

        // _debug($select);
    }

    if($sql_query){
        echo "<script type='text/javascript'>
        alert('Importação realizada com sucesso.');
        window.location='index.php';
        </script>";
    }else{
        echo "<script type='text/javascript'>
        alert('Importação não realizada.');
        </script>";
    }

  // header('location: index.php');

    // $response['result'] = 'success';
    // $response['message'] = 'Dados importados com Sucesso.';
    // $response['data'] = $otherDado;
    // echo json_encode($response, JSON_FORCE_OBJECT);

    exit;

} else {
 echo "<script type='text/javascript'> alert('Arquivo Inválido. Por favor, envie arquivos Excel com as seguintes extensões: XLS ou XLSX'); </script>";
        // $response['result'] = 'error';
        // $response['message'] = 'Arquivo Inválido. Por favor, envie arquivos Excel com as seguintes extensões: XLS ou XLSX';
        // $response['data'] = null;
        // echo json_encode($response, JSON_FORCE_OBJECT);
 exit;
}
} else {
    echo "<script type='text/javascript'> alert('Erro. Não foi possivel importar. Tente novamente.'); </script>";
    // $response['result'] = 'error';
    // $response['message'] = 'Erro. Não foi possivel importar. Tente novamente.';
    // $response['data'] = null;
    // echo json_encode($response, JSON_FORCE_OBJECT);
    exit;
}

<script>
  function copiarTexto() {
    var textoCopiado = document.getElementById("link");
    textoCopiado.select();
    document.execCommand("Copy");
    alert("copiado o link: " + textoCopiado.value);
  }
</script>

<input type="text" id="link" name="link" value="http://www.teste.com/teste" readonly> <button onClick="copiarTexto()">Copiar Texto</button>

<?php

$name = (object) null;

$name->HTTP_HOST = $_SERVER['HTTP_HOST'];
$name->ERVER_NAME = $_SERVER['SERVER_NAME'];
$name->HTTP_REFERER = $_SERVER['HTTP_REFERER'];
$name->REQUEST_URI = $_SERVER['REQUEST_URI'];

echo '<pre>';
echo print_r($name);

?>
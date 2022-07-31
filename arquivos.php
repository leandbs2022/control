<?php
session_start();
$for = $_SESSION[ 'nota' ];
?>
<!doctype html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<title>Upload de imagens</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
  <p>
  <h1>Controle de notas e recibos</h1>
  </p>
  <hr>
  <form method="POST" enctype="multipart/form-data">
    <label for="conteudo">Enviar imagem:</label>
    <input type="file" name="pic" accept="image/*" class="form-control">
    <div align="left">
      <button type="submit" class="btn btn-success">Confirmar envio</button>
      <input name="voltar" type="submit" class="btn btn-info btn-sm" id="voltar" formaction="fornecedores.php" value="VOLTAR FORNECEDOR"  align="left"/>
      <p>&nbsp;</p>
      <p>
      <h6>
      <?php echo "Empresa: ".$for?>
      </p>
    </div>
  </form>
  <hr>
  <?php

  if ( isset( $_FILES[ 'pic' ] ) ) {

    $ext = strtolower( substr( $_FILES[ 'pic' ][ 'name' ], -4 ) ); //Pegando extensão do arquivo
    $new_name = date( " d-m-Y h.i.s" ) . $for . $ext; //Definindo um novo nome para o arquivo
    $dir = './imagens/NFE/'; //Diretório para uploads

    move_uploaded_file( $_FILES[ 'pic' ][ 'tmp_name' ], $dir . $new_name ); //Fazer upload do arquivo
    echo '<div class="alert alert-success" role="alert" align="center">
          <img src="./imagens/NFE/' . $new_name . '" class="img img-responsive img-thumbnail" width="200"> 
          <br>
          Imagem enviada com sucesso!
          <br>
          <a href="fornecedores.php">
          <button class="btn btn-default">retornar a fornecedor</button>
          </a></div>';
  }
  $path = ".\imagens\NFE/";
  echo "<h1>Lista de Arquivos:</h1><br />";
  foreach ( new DirectoryIterator( $path ) as $fileInfo ) {
    if ( $fileInfo->isDot() ) continue;
    echo "<table><td><a target=_blank href='" . $path . $fileInfo->getFilename() . "'>" . $fileInfo->getFilename() . " </a><br /></td></tr></table>";
  }
  ?>
</div>
	<script > 
    var idleTime = 0;
    $(document).ready(function () {
    //Increment the idle time counter every minute.
    if($('iframe').length < 1) // caso não exista iframe vamos incrementar o contador (idleTime) de 1 em 1 minuto
        var idleInterval = setInterval(timerIncrement, 60000); // 1 minutos

    // resetamos o contador caso sejam detetados estes eventos
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
    $(window).on('scroll', function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 14) { // 15 minutes
      document.location.href = "index.php";
    }
}
</script>
<body>
</html>
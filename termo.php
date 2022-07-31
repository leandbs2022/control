<?php
	$nome ="";
	$produto="";
	$dest ="";
	$cpf="";
	
	?>
<!doctype html>
<html>
	
	
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css/styles.css" rel="stylesheet" type="text/css" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Documento sem título</title>
</head>

<body>
	<div class="container " align="center">
	  <p>&nbsp;</p>
	  <p align="center"><strong><img src="img/catedral.png" width="224" height="78"><br>
	    <br>
	    <br>
	    </strong><strong><u> </u></strong></p>
      <p align="center"><strong><u></u></strong></p>
      <p align="center"><strong><u>DECLARAÇÃO DE ENTREGA</u></strong><br>
        <br>
        <br>
        <br>
        Eu, <strong><em><strong><em>
        <input name="nome" type="text"  id="nome" value="" size="30" maxlength="30" />
        </em></strong></em></strong>,  CPF:<strong><em><strong><em>
        <input name="cpf" type="text"  id="cpf" value="" size="15" maxlength="15" />
        </em></strong></em></strong> declaro para todos os fins, que estou recebendo da <strong>CATEDRAL TURISMO <em><strong><em>
        <input name="produto" type="text"  id="produto" value="" size="30" maxlength="30" />
        </em></strong></em></strong>.<br>
  <strong> </strong><br>
  <strong>Destino do produto:<em><strong><em>
  <input name="destino" type="text"  id="destino" value="" size="50" maxlength="50" />
  </em></strong></em>.</strong></p>
      <p>&nbsp;</p>
      <p align="right"> Brasília <?php echo date("d");?>, de <?php echo date("m");?> de <?php echo date("Y");?>.      </p>
      <p align="center">__________________________<br>
      Assinatura</p>
      <p align="center">&nbsp;</p>
      <p align="center">_________________________<br>
        T.I</p>
		<form action="" method="post">
<div id="print" class="container">
   <?php
  $nome = $_POST['nome'];
  $produto = $_POST['produto'];
  $dest = $_POST['destino'];
  $cpf = $_POST['cpf'];
  ?>
</div>
        <input type="button" onclick="cont();" value="Imprimir">
    </form>

<script>
function printDiv(divID)  
        {
        var conteudo = document.getElementById(divID).innerHTML;  
        var win = window.open();  
        win.document.write(conteudo);  
        win.print();  
        win.close();//Fecha após a impressão.  
        } 
        function cont(){
   var conteudo = document.getElementById('print').innerHTML;
   tela_impressao = window.open('about:blank');
   tela_impressao.document.write(conteudo);
   tela_impressao.window.print();
   tela_impressao.window.close();
}
    </script>
</body>
</html>
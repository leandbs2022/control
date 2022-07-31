<?php
require( "./class/class.cst.php" );
require( "./conectar.php" );
$ICB = new cst;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Imprimir</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
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
<body >
    <form action="" method="post">
<div id="print" class="container">
   <?php
  $campo = "";
  $busca = "";
  $nivel = "2";
  $resposta = $ICB->imprimir( $campo, $busca, $nivel );
  ?>
</div>
        <input type="button" onclick="cont();" value="Imprimir">
    </form>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require("./class/class.cst.php");
require("./conectar.php");
require_once("dompdf/dompdf_config.inc.php");
$ICB = new cst;
$cnpj= "";
$ip  = "";
$pc = "";
$dep  = "";
$resp = "";
$team ="";
$ramal  = "";
$desc="";
$carg= "";
$loc= "";
$campo ="";
$senha="1443106";
$cript="0";
?>
<title>Cadastro de dados</title>
<link href="css/mai.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script></head>

<body background="img\fundo.jpg">
<p align="center"><em>
  <label for="teste"></label>
</em>
  <label></label>
  <em>
  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="conhecimento.php" target="display" >Informações Ramal e Ips </option>
    <option value="conhecimento.php" target="display" >Fornecedores</option>
    <option value="conhecimento.php">Banco de Conhecimento</option>
    <option value="usuarios.php">Usuarios</option>
  </select>
  </em>
  
</p>
<form name="form" id="form" method="post">
  <input type="submit" name="teste" id="teste" value="teste"  />
  <?php 
   		if(isset($_POST['teste'])) 
  		{
  			$senha = "123456";
			$textoCriptografado =  base64_encode($senha);
			$textoDescriptografado =  base64_decode($textoCriptografado);
			echo "O valor do texto criptografado é: $textoCriptografado, é seu valor original é: $textoDescriptografado";
			 
  		}
  ?>
  <p align="center"><strong><a href="redes.php" target="display"><img src="img/icons/Fork_4_Icon_64.png" alt="teste" width="64" height="64" align="middle"  target="display"/></a>Deposito</strong>  
  <p align="center">
  <p align="center">
  <p align="center"><iframe src="logo.php" name="display" width="1280" marginwidth="0" height="720" marginheight="0" frameborder="0" class="style4" id="display" ></iframe>
  
</form>
<p align="left"><em></em><label></label>
</p>
<p align="left">
  <label></label>
</p>
<p align="left">&nbsp;</p>
</body>
</html>
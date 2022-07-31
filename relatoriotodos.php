<?php
require_once("dompdf/dompdf_config.inc.php");
require("./conectar.php");
require("./class/class.cst.php");
$ICB = new cst;
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Relatorio</title>
</head>
<body>
<?php				
	$entrada = $_SESSION['entrada'];
    $saida = $_SESSION['saida'];
	
if(empty($entrada) || empty($saida)){
	echo"Sem dados para impressão";
	echo $entrada.$saida;
}else{
$responsavel=$ICB->lista_docs($entrada,$saida);
header("Content-type: application/vnd.ms-excel");   
header("Content-Disposition: attachment; filename=Relatorio.xls");
header("Pragma: no-cache");
exit;
	}
?>
</body>
</html>
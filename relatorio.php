<?php
require("./conectar.php");
require("./class/class.dasa.php");
$dasa = new dasa;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Relatorio</title>
</head>
<body>
<?php
	session_start();
		$codigo = $_SESSION['Relatorio'];
		$itens = $_SESSION['TipoR'];
	switch ($itens) 
		{
    	case 'unidades':
      		 $resposta=$dasa->unidades($codigo);	
        break;
		
    	case "equipamentos":
        	$resposta=$dasa->equipe($codigo);	
        break;
		default:
       		echo "Não existe o numero definido";
	 	}
header("Content-type: application/vnd.ms-excel");   
header("Content-Disposition: attachment; filename=Relatorio.xls");
header("Pragma: no-cache");
?>
</body>
</html>



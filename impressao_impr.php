<?php 
require("./class/class.cst.php");
require("./class/class.tonner.php");
require("./conectar.php");
$ICB = new cst;
session_start();
$IMPRESSÃO = $_SESSION['IMPRESSAO'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>  
    <meta charset="utf-8">
    <title>RELATÓRIO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Impressão com PDV">
    <meta name="author" content="Leandro Barbosa">
</head>
<script type="text/javascript">
        window.print();
        //window.close(); Só descomente esta linha se tiver o modo kiosk habilitado
    </script>
<body>
    <div style="" align="center">

        <?php 
			switch ($IMPRESSÃO) 
			{
    			case "IMPRESSORAS":
				$responsavel=$ICB->impressoras();
				break;
				case "REDE":
				$busca  = $_SESSION['exec'];
				$campo= $_SESSION['pesq'];
        		$responsavel=$ICB->excel($campo,$busca);
       			break;
			}
		?>

    </div>

</body>
</html>
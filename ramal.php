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
$busca = "";
$tipo_t = "";
session_start();
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
$_SESSION['tipo_T']="R";
#$_SESSION['utilizador'] = "ICB";
#$_SESSION['nivel'] =1;
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$tipo_t = $_SESSION['nivel'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Cadastro de dados</title>
<span id='topo'></span>

<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body background="">
<p align="left"><em>
  <label for="teste"></label>
</em>
  <?php
$datedia = date('d/m/Y');
if($_SESSION['nivel'] <> 2)
{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>" ; 
}else{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ; 
}
?>
  </p>
</p>
<p align="center"><span class="style6"> INFORMAÇÕES RAMAIS</span>	<em>
  <?php
  
 if(isset($_POST['LOC'])) 
  	{
		$busca =  $_POST['txtloc'];
		$descri= $_POST['pes'];
		switch ($descri) 
			{
    			case 0:
       				$campo = "ip";
        		break;
    			case 1:
        			$campo = "ram";
       			break;
    			case 2:
        			$campo = "host";
        		break;
				case 3:
        			$campo = "dep";
        		break;
				case 4:
        			$campo = "resp";
        		break;
				case 5:
        			$campo = "loc";
        		break;
			}	
		$respo=$ICB->lista_C($campo,$busca,$nivel,$tipo_t);
	}
?>
</em></p>
<form id="form1" name="form1" method="post" action="" >
  <table width="1558" border="1">
    <tbody>
      <tr>
        <th height="18" bgcolor="#000000" scope="col"></th>
      </tr>
    </tbody>
  </table>
  <p>&nbsp;</p>
  <label>Tipo:<label></label>
  <select name="pes" id="pes">
    <option value="1">RAMAL</option>
    <option value="3">DEPART</option>
    <option value="4">USUARIO</option>
    <option value="5">LOCAL</option>
  </select>
  <label>Dig.:</label>
  <input name="txtloc" type="text" class="Leandro" id="txtloc"  onchange="return bar()"/>
  </label>
  <input type="submit" name="LOC" id="LOC" value="Localizar" />
  <input type="submit" name="visual" id="visual" value="Visualizar todos" />
  <label for="Salvar xls"></label>
  <input type="submit" name="Salve" id="Salve" value="Excel" />
  <label></label>
  <p><label>Informações encontradas:</label>&nbsp;</p>
  <p>
    <?php
            
			 if(isset($_POST['Salve'])) 
  			{
				$localize = $_POST['txtloc'];
				$descri= $_POST['pes'];
				
				switch ($descri) 
					{
    				case 0:
       					$campo = "ip";
        			break;
    				case 1:
        				$campo = "ram";
       				 break;
    				case 2:
        				$campo = "host";
        			break;
					case 3:
        				$campo = "dep";
        			break;
					case 4:
        				$campo = "resp";
        			break;
					case 5:
        				$campo = "loc";
        			break;
					
					}
					$_SESSION['exec'] = $localize;
					$_SESSION['pesq'] = $campo;
					
						if(empty($localize))
							{
								echo "Favor verificar se há algum item digitado na pesquisa!!!";
							}else{
								header('Location: relatoriotodos.php');
							}

   			 }
	if(isset($_POST['visual'])) 
  		{
			$resposta = $ICB-> lista($campo,$busca,$nivel,$tipo_t);
		}
?>
  </p>
  <?php 
  ?>
</form>
</body>
</html>
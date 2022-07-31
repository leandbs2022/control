<?php
require("./class/class.lembrei.php");
require("./conectar.php");
require_once("dompdf/dompdf_config.inc.php");
$ICB = new lembrei;
$dep  = "";
$resp = "";
$descri = "";
session_start();
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
#$_SESSION['utilizador'] = "ICB";
#$_SESSION['nivel'] =1;
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$_SESSION['tipo_T']="Re";
$tipo_t = $_SESSION['nivel'];
$data = date('d/m/Y');
$busca = $_SESSION['ID'];
$userid = $_SESSION['ID'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Cadastro de dados</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<style type="text/css">
<!--
.style8 {font-size: 24px}
-->
</style>
</head>

<body background="">
<p align="center"><em>
  <label for="teste"></label>
</em><em><span class="style6">LEMBRETE</span>
  <?php

if($_SESSION['nivel'] == 0)
{
	#echo "<p align=left><em></em>Login: <label>{$nome} (PadrÃ£o) </label>  Data:<label> {$datedia}</label>" ; 
	header('Location: BLOQUEIO.php');
}else{
	$tipo =1;
	$respo=$ICB->visualize($busca,$data,$tipo);	
}	
?>
</em></p>
<table width="1558" border="1">
  <tbody>
    <tr>
      <th height="18" bgcolor="#000000" scope="col"></th>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="" >
  <p>  
    <label for="CNPJ"></label><em>
    <label for="label2">Data:</label>
    <input name="DT" type="date" class="Leandro" id="DT" value="<?php echo $data; ?>" size="15" maxlength="12"/>
    </em><em>
  <label for="label2">
Usuário:</label>
  <input name="RESP" type="text" class="Leandro" id="RESP" size="15" maxlength="20" value="<?php echo $nome; ?>"/>
  </em><em>
  <input type="submit" name="Salvar" id="Salvar" value="Adicionar Lembrete" />
  <label>
  <input type="submit" name="Vi" id="Vi" value="Visualizar todos" />
  </label>
  </em>
  <label></label>
  </p>
  <p><em>
    <label for="IP"></label>
    <label for="label2"></label>
  </em><em>
  <label for="label">Digite seu lembrete:</label>
  </em></p>
  <p><em>
    <label for="NOME PC"></label>
  </em><em>
  <label for="label"></label>
  </em><em>
  <textarea name="OBSER" cols="180" rows="2" class="Leandro" id="OBSER"><?php echo $descri; ?></textarea>
  </em></p>
  <p><em>
    <label for="RESP"></label>
    <label for="label2"></label>  
    <label for="OBSER"></label>
    <?php 
  if(isset($_POST['Salvar'])) 
			{
				$sql = mysqli_query("SELECT * FROM login where Codigo = '$userid' ");
				if(mysqli_num_rows($sql))
				{
					while($array = mysql_fetch_row($sql)) 
					{
  						$dep = $array[3];
					}
				}	
				
				$userid = $_SESSION['ID'];
				$data = $_POST['DT'];
				$descri=$_POST['OBSER'];		
				if(empty($data)){
					echo "Digite a data !!!! ";
					}else{
				$respo=$ICB->adicionar_lemb($userid,$dep,$data,$descri);
				}
		}
		 if(isset($_POST['Vi'])) 
			{
				$tipo = 0 ;
				$respo=$ICB->visualize($busca,$data,$tipo);
				
			}
  ?>
    <?php 
  		if(isset($_POST['teste2'])) 
			{
				
				
			}
  ?>
  </em></p>
  <table width="1558" border="1">
    <tbody>
      <tr>
        <th height="18" bgcolor="#000000" scope="col"></th>
      </tr>
    </tbody>
  </table>
  <p><em>
    <label for="OBSER"><br />
    </label>
  </em></p>
</form>
</body>
</html>
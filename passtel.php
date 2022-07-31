<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
#conexão do banco e declaração das classes
require("./conectar.php");
require("./class/class.cst.php");
$itens = new cst;
#Variaveis cadastro
$nome= "";
$senha= "";
#variaveis de pesq.
$busca = "";
#Variaveis Globais
session_start();
#pesquisa global
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$depart =$_SESSION['depart'];
?>
<title>Cadastro de covênios</title>
<link href="css/mai.css" rel="stylesheet" type="text/css" />
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
.style11 {
	color: #0000FF;
	font-weight: bold;
}
.style12 {color: #0000FF}
-->
</style>

</head>
<body load="" background="" >
<p align="center"><em>
  <label for="teste"></label>
  <?php
if($_SESSION['nivel'] <> 2)
{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>" ;
	header('Location: BLOQUEIO.php');	 
}else{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ;
	$nome= "";
$senha= ""; 
}
?>
</em><span class="style6">SENHAS TELEFONICAS</span>	<em>
  <?php
  
 if(isset($_POST['status'])) 
  	{
	$busca =  $_POST['cmbnome'];
	$query = mysqli_query("SELECT * FROM `tel_sen` WHERE  Nome='$busca'");
	if(mysqli_num_rows($query))
		{
		while($array = mysql_fetch_row($query)) 
				{		
					$nome=$array[0];
					$senha= $array[1];
				}
		}else{
			
		}
	}
?>
</em>

</p>
<p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
<form id="form1" name="form1" method="post" action="" >
  <p>  
    <label for="CNPJ"></label>
    <em>
    Senha tel
    <label for="label2"></label>
    :
    <input name="sen" type="text" class="" id="sen" value="<?php echo $senha; ?>" size="40" maxlength="30"/>
    Funcionário
    </em><em>
    <label for="label2">:</label>
    
  <input name="func" type="text" class="auto" id="func" value="<?php echo $nome; ?>" size="75"/>
  </em></p>
  <p><em>
    <input type="submit" name="Salvar" id="Salvar" value="Novo/Alterar" />
    <input type="submit" name="status" id="status" value=" Localizar funcionário" />
    <select name="cmbnome" id="cmbnome">
      <?php
      $sql = mysqli_query("SELECT * FROM `tel_sen` where 1 ORDER BY NOME ASC");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['Nome'].'">'.$monta['Nome'].'</option>';
      }
	 ?>
    </select>
  </em></p>
  <p><em>
    <label for="label2"></label>
  </em><em><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></em></p>
  <p><em>
    <label for="label2"></label>
  </em><em>
<label for="label2"></label>
  </em><em>
  <label for="label2"></label>
  </em><em>
  <?php
	
if(isset($_POST['Salvar'])) 
  	{			
		$nome= $_POST['func'];
		$senha = $_POST['sen'];
		if($nivel <> 2)
			{
				echo "<b><font color=red>Você não tem permissão de salvar ou alterar dados!!!</font></b>";
			}
			else
			{
				
				$resposta = $itens-> adicionar_sen_tel($nome,$senha); 
			}
	}
	?>
  </em><br />
  <label></label>
</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><em>
    <label for="IP"></label>
    <label for="label2"></label>
    <label for="label2"></label>
  </em><em>
  <label for="label2"></label>
  </em>
  <label></label>
  <em>
  <label for="NOME PC"></label>
    <label for="label2"></label>
  </em><em>
  <label for="label2"></label>
  </em>



  <label></label>
  <label></label>
  <em>
  <label for="label2"><span class="style11"></span></label>
  </em></p>
  <em>
  <p>
    <label></label>
    <em>
    <label for="infor"><br />
    </label>
    </em></p>
  </em>
</form>
</body>
</html>
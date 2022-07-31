<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require("./class/class.cst.php");
	require("./class/class.tonner.php");
	require("./conectar.php");
	require_once("dompdf/dompdf_config.inc.php");
$ICB = new cst;
$to = new tonner;
$ip  = "";
$marca = "";
$modelo  = "";
$local = "";
$campo ="";
$busca = "";

$ton = "";
$model = "";
$quant = 0;
$unid = "";

session_start();
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
#$_SESSION['utilizador'] = "ICB";
#$_SESSION['nivel'] =1;
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
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
	header('Location: BLOQUEIO.php');
}else{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ; 
}
?>

  </p>
<span class="style6">CADASTRO DE IMPRESSORAS</span>	<em>
  <?php
  if(isset($_POST['Salve'])) 
  	{
			$busca =  $_POST['IP'];
			$campo = "ip";
			if(($nivel == 2) )
				{
					$respo=$ICB->lista_impr($campo,$busca,$nivel);
					$query = mysqli_query("SELECT * FROM `impr` WHERE  $campo='$busca' ");
					if(mysqli_num_rows($query))
						{
						while($array = mysql_fetch_row($query)) 
							{		
								$ip  = $array[0];
								$marca  = $array[2];
								$modelo  = $array[3];
								$local = $array[1];
							}
						}
				}
	}
	
 if(isset($_POST['LOC'])) 
  	{
			$busca =  $_POST['pes'];
			$campo = "loc";
			if(($nivel == 2) )
				{
					$respo=$ICB->lista_impr($campo,$busca,$nivel);
					$query = mysqli_query("SELECT * FROM `impr` WHERE  $campo='$busca' ");
					if(mysqli_num_rows($query))
						{
						while($array = mysql_fetch_row($query)) 
							{		
								$ip  = $array[0];
								$marca  = $array[2];
								$modelo  = $array[3];
								$local = $array[1];
							}
						}
				}
	}
?>
</em></p>
<p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
<form id="form1" name="form1" method="post" action="" >
  <p>  
    <label for="CNPJ"></label>
    :<em>
    <label for="label2">IP</label>
    :
    <input name="IP" type="text" id="IP" maxlength="15" value="<?php echo $ip; ?>"/>
    <label for="label2">Marca:</label>
    <input name="marca" type="text" class="Leandro" id="marca" maxlength="15" value="<?php echo $marca; ?>"/>
  </em><em>Modelo
    :
  <input name="modelo" type="text" class="Leandro" id="modelo" size="40" maxlength="15" value="<?php echo $modelo; ?>"/>
  <label for="label2"></label>
  </em><em>
  <label for="label2">Local:</label>
  <input name="LOC2" type="text" class="Leandro" id="LOC2" size="30" maxlength="15" value="<?php echo $local; ?>"/>
  <label for="label2"></label>
  </em></p>
  <p><em>
    <label for="IP"></label>
    <label for="label2"></label>
  </em>
    <input type="submit" name="Salvar" id="Salvar" value="Novo/Alterar" />
    <input type="submit" name="Salve" id="Salve" value="Loc por IP" />
    <input type="submit" name="del" id="del" value="Delete" />
  <?php 
	if(isset($_POST['Salvar'])) 
  	{	
		$ip  = $_POST['IP'];
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];
		$local = $_POST['LOC2'];
		#echo "<label>{$ip}{$marca}{$modelo}{$local}  </label>" ;
		if($nivel <> 2)
		{
				echo "Voce nao tem permissao de salvar ou alterar dados!!!";
		}
		else
		{
				$resposta = $ICB-> adicionar_impr($ip,$marca,$modelo,$local);
		}
	}
	 
	if(isset($_POST['del'])) 
  	{
	$ip = $_POST['IP'];
		if($nivel <> 2){
				echo "Voce nao tem permissao de excluir dados!!!";
		}
		else
		{
		$resposta = $ICB-> delete_impr($ip);
		}
	}
	
	?>
  </p>
  <table width="975" border="0">
    <tr>
      <th width="93" scope="col"><div align="right">
          <select name="pes" id="pes" value="<?php echo $local; ?>">
            <option ><?php echo $local; ?></option>
            <?php
	$sql = mysqli_query("SELECT * FROM `impr` WHERE 1");
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['loc'].'">'.$monta['loc'].'</option>';
      }
	 
      ?>
          </select>
      </div></th>
      <th width="153" scope="col"> <div align="right">
          <input type="submit" name="LOC" id="LOC" value="Localizar impressora" />
      </div></th>
      <th width="73" scope="col"><div align="left">
          <input type="submit" name="visual" id="visual" value="Visualizar Impressoras" />
      </div></th>
      <th width="82" scope="col"> <div align="left">
          <input type="submit" name="imp" id="imp" value="Impressão - Lista impressoras" />
      </div></th>
      <th width="363" scope="col"><div align="left"></div></th>
      <th width="185" scope="col">&nbsp;</th>
    </tr>
  </table>
  <table width="200" border="0">
    <tr>
      <th scope="col"><div align="left"><?php 
	if(isset($_POST['imp'])) 
  		{
		$_SESSION['IMPRESSAO'] = "IMPRESSORAS";
		header('Location: impressao_impr.php');	
		
	}
	if(isset($_POST['busca'])) 
  		{
		
		$ton  = $_POST['cmb']; 
		$query = mysqli_query("SELECT * FROM `impr_tonner` WHERE  ton='$ton' ");
		if(mysqli_num_rows($query))
			{
			while($array = mysql_fetch_row($query)) 
				{		
					$ton  = $array[0];
					$model  = $array[1];
					$quant  = $array[2];
				}
			}else{
					#echo "nenhum registro encontrado!!!!";
			}		
		}
		 if(isset($_POST['visual'])) 
  		{
			$resposta = $ICB-> lista_impr($campo,$busca,$nivel);
		}
	?>
      </div>      </th>
    </tr>
  </table>
  <p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /> </p>
  <p><em>
    <label for="NOME PC"></label>
  </em>
    
    <label></label>
  <label for="Salvar xls"></label>
  <span class="style1">CADASTRO DE TONER</span>
  
  <table width="1367" border="0" align="left">
    <tr>
      <th width="41" scope="col"><div align="left">
        <select name="cmb" id="cmb" onclick="<?php echo $ton; ?>">
          <option ><?php echo $ton; ?></option>
          <?php
	$sql = mysqli_query("SELECT ton FROM `impr_tonner` WHERE 1");
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['ton'].'">'.$monta['ton'].'</option>';
      }
      ?>
        </select>
      </div></th>
      <th width="111" scope="col"><div align="left">
        <input type="submit" name="busca" id="busca" value="Localizar Tonner" />
      </div></th>
      <th width="134" scope="col"><div align="left">
        <input type="submit" name="visua" id="visua" value="Visualizar Est. Toner" />
      </div></th>
      <th width="98" scope="col"><div align="left">
        <input type="submit" name="del2" id="del2" value="Excluir Tonner" />
      </div></th>
      <th width="125" scope="col"><div align="left">
        <input name="tonner" type="submit" id="tonner" value="Adic.Alter - Tonner" />
      </div></th>
      <th width="832" scope="col"><div align="left">Tonner:
          <input name="toner" type="text" id="toner" size="12" maxlength="30" value="<?php echo "$ton"; ?>"/>
          <label>Modelo:</label>
          <input name="model" type="text" id="model" size="15" maxlength="50" value="<?php echo "$model"; ?>" />
Quant:
<input name="quant" type="text" id="quant" size="2" maxlength="2" value="<?php echo "$quant"; ?>" />
      <select name="local" id="local">
        <option>SOF SUL</option>
        <option>ROD.BSB</option>
		<option>ROD.TAG</option>
		<option>ROD.INGAR</option>
		<option>ROD.GO</option>
      </select>
      </div>
      <label></label></th>
    </tr>
  </table>
  <p>
    <label>Informações do estoque:</label>
  </p>
  <p><em>
    <label for="DEP"></label>
    <label for="label2"></label>
  </em><em>
    <label for="RESP"></label>
    <label for="label2"></label>  
    <label for="OBSER"></label>
  </em>
  <table width="961" border="0">
    <tr>
      <th scope="col"><div align="left">
          <?php
	
      
		if(isset($_POST['visua'])) 
  		{
			$busca = "";
			$resposta = $to-> lista_tonner($busca);
		}
		if(isset($_POST['tonner'])) 
  		{
			if($nivel <> 2){
				echo "Voce nao tem permissao de adicionar ou alterar dados!!!";
				}
				else
				{
					$ton  = $_POST['toner']; 
					$model = $_POST['model']; 
					$quant = $_POST['quant'];
					$unid = $_POST['local'];
					$respo=$to->adicionar_tonner($ton,$model,$quant,$unid);
					$query = mysqli_query("SELECT * FROM `impr_tonner` WHERE  ton='$ton' ");
					if(mysqli_num_rows($query))
						{
						while($array = mysql_fetch_row($query)) 
							{		
								$ton  = $array[0];
								$model  = $array[1];
								$quant  = $array[2];
								$unid  = $array[3];
							}
							
						}
			}
		}
		if(isset($_POST['del2'])) 
  			{
			$ton = $_POST['cmb'];
			
			if($nivel <> 2){
				echo "Voce nao tem permissao de excluir dados!!!";
				}
				else
				{
					$resposta = $to-> delete_tonner($ton,$model);
				}
	}
	 
?>
      </div></th>
    </tr>
  </table>
  <p><em>
    <label for="OBSER"><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /><br />
    </label>
    </em>
  </form>
</body>
</html>
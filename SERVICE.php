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
?>
<title>Cadastro de dados</title>
<link href="css/mai.css" rel="stylesheet" type="text/css" />
</head>

<body background="">
<p align="center"><em>
  <label for="teste"></label>
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
				}
		#$respo=$ICB->list($campo)
		$query = mysqli_query("SELECT * FROM `red_tel` WHERE  $campo='$busca' ");
		if(mysqli_num_rows($query))
		{
			while($array = mysql_fetch_row($query)) 
			{		
				$ip  = $array[0];
				$pc  = $array[1];
				$dep  = $array[2];
				$resp = $array[3];
				$team  =$array[4];
				$ramal= $array[5];
				$carg = $array[6];
				$loc = $array[7];
				$desc= $array[8];
				$cnpj= $array[9];
			}
			
		}
		
	}
		
?>
</em><strong>CADASTRO DE INFORMAÇÕES ICB</strong></p>
<p><img src="img/fv_02.jpg" alt="rr" width="1350" height="21" align="bottom" lowsrc="Drag to a file to choose it." /></p>

<form id="form1" name="form1" method="post" action="" >
  <p>  
   
    <label for="CNPJ">CNPJ</label>
    :<em>
    <input name="CNPJ" type="text" id="CNPJ" maxlength="14" tipo="number" value="<?php echo $cnpj; ?>"/>
    <label for="label2">IP</label>
    :
    <input name="IP" type="text" id="IP" maxlength="13" value="<?php echo $ip; ?>"/>
    <label for="label2">Host:</label>
    <input name="HOST" type="text" class="Leandro" id="HOST" maxlength="15" value="<?php echo $pc; ?>"/>
  </em></p>
  <p><em>
    <label for="IP"></label>
    <label for="label2"></label>
    Depar:
    <input name="DEP" type="text" class="Leandro" id="DEP" size="40" maxlength="15" value="<?php echo $dep; ?>"/>
    <label for="label2"> Usuário:</label>
    <input name="RESP" type="text" class="Leandro" id="RESP" size="38" maxlength="20" value="<?php echo $resp; ?>"/>
    </em></p>
  <p><em>
    <label for="NOME PC"></label>
  Team :
  <input name="TEAM" type="text" id="TEAM" size="40" maxlength="10" value="<?php echo $team; ?>"/>
  <label for="label2"> Ramal:</label>
  <input name="RAM" type="text" id="RAM" size="39" maxlength="4" value="<?php echo $ramal; ?>"/>
    </em></p>
  <p><em>
    <label for="DEP"></label>
    <label for="label2">Local:</label>
    <input name="LOC2" type="text" class="Leandro" id="label" size="40" maxlength="15" value="<?php echo $loc; ?>"/>
    <label for="label2">Cargo :</label>
    <input name="CARGO" type="text" class="Leandro" id="CARGO" size="40" maxlength="15" value="<?php echo $carg; ?>"/>
    </em></p>
  <p><em>
    <label for="RESP"></label>
    <label for="label2"></label>  
    <label for="OBSER">INFORMAÇÃO ADICIONAL</label>
    <label for="OBSER"><br />
    </label>
    <input name="OBSER" type="text" class="Leandro" id="OBSER" value="<?php echo $desc; ?>" size="100" />
</em></p>
  <p>
    <input type="submit" name="Salvar" id="Salvar" value="Novo/Alterar" />
    <input type="submit" name="del" id="del" value="Delete" />
    <?php 
	if(isset($_POST['Salvar'])) 
  	{	
		$cnpj= $_POST['CNPJ'];
		$ip  = $_POST['IP'];
		$pc = $_POST['HOST'];
		$dep  = $_POST['DEP'];
		$resp = $_POST['RESP'];
		$team = $_POST['TEAM'];
		$ramal  = $_POST['RAM'];
		$desc= $_POST['OBSER'];
		$carg= $_POST['CARGO'];
		$loc= $_POST['LOC2'];
		$resposta = $ICB-> adicionar($cnpj,$ip,$pc,$dep,$resp,$team,$ramal,$carg,$loc,$desc);
	}
	
	if(isset($_POST['del'])) 
  	{
	$ip = $_POST['IP'];
	$resposta = $ICB-> delete($ip);
	}
	?>
  </p>
  <p><img src="img/fv_02.jpg" alt="rr" width="1350" height="21" align="bottom" lowsrc="Drag to a file to choose it." /></p>
  <label>Pequisa
  <select name="pes" id="pes">
    <option value="0">IP</option>
    <option value="1">RAMAL</option>
    <option value="3">DEP</option>
    <option value="4">RESP</option>
  </select>
  <input type="text" name="txtloc" id="txtloc"  onchange="return bar()"/>
  </label>
  <input type="submit" name="LOC" id="LOC" value="Enviar" />
  <input type="submit" name="visual" id="visual" value="Visualizar todos" />
  <label for="Salvar xls"></label>
  <input type="submit" name="Salve" id="Salve" value="Excel" />
  <p>
    
    <?php
            if(isset($_POST['visual'])) 
  			{
			$resposta = $ICB-> lista();
			   			 }
			 if(isset($_POST['Salve'])) 
  			{
			header('Location: relatoriotodos.php');	
   			 }
			
			?>         
  </p>
</form>
</body>
</html>
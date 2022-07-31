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
$busca = "";
session_start();
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
#$_SESSION['utilizador'] = "ICB";
#$_SESSION['nivel'] =1;
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$_SESSION['tipo_T']="Re";
$tipo_t = $_SESSION['nivel'];
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
<style type="text/css">
<!--
.style8 {font-size: 24px}
.fontes {	font-size: 14px;
}
.style5 {	font-size: 9px;
	font-style: italic;
}
-->
</style>
</head>

<body background="">
<p align="left"><em>
  <label for="teste"></label>
</em></p>
<?php
$datedia = date('d/m/Y');

if($_SESSION['nivel'] <> 2)
{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>" ;
	header('Location: BLOQUEIO.php');	 
}else{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ; 
	
	 echo "<a href=inventario.php>Volta</a>";
}
?>
</p>
<p align="center"><span class="style6">CADASTRO ELETRONICOS</span><em>
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
				if(($nivel == 1)) 
					{
						if(($busca == "ti") || ($campo == "ip") || ($campo == "host")) 
							{
									echo "Voce nao tem permissão de consulta {$busca}";
							}else{
									$respo=$ICB->lista($campo,$busca,$nivel,$tipo_t);
							}
					}
			if(($nivel == 2) )
				{
					$respo=$ICB->lista($campo,$busca,$nivel,$tipo_t);
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
	}
?>
</em></p>
<p><img src="img/fv_02 cópia.png" alt="wwww" name="teste" width="1435" height="13" align="top" /></p>
<form id="form1" name="form1" method="post" action="" >
  <p>  
    <label for="CNPJ"></label>
  </p>
  <p><img src="img/fv_02 cópia.png" alt="wwww" name="teste" width="1435" height="13" align="top" id="teste" /></p>
  <p><em>
    <label for="IP"></label>
    <label for="label2"></label>
  </em></p>
  <p><img src="img/fv_02 cópia.png" alt="wwww" name="teste" width="1435" height="13" align="top" id="teste2" /></p>
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
		if($nivel <> 2){
				echo "Voce nao tem permissao de salvar ou alterar dados!!!";
		}
		else
		{
		$resposta = $ICB-> adicionar($cnpj,$ip,$pc,$dep,$resp,$team,$ramal,$carg,$loc,$desc);
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
		$resposta = $ICB-> delete($ip);
		}
	}
	?>
  </p>
  <p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
  <label>Tipo:<label></label>
  <select name="pes" id="pes">
    <option value="0">IP</option>
    <option value="1">RAMAL</option>
    <option value="2">PC</option>
    <option value="3">DEPART</option>
    <option value="4">USUARIO</option>
    <option value="5">LOCAL</option>
  </select>
  <label>Item:</label>
  <input name="txtloc" type="text" class="Leandro" id="txtloc"  onchange="return bar()"/>
  </label>
  <input type="submit" name="LOC" id="LOC" value="Localizar" />
  <input type="submit" name="visual" id="visual" value="Visualizar todos com ramais" />
  <label for="Salvar xls"></label>
  <input type="submit" name="Salve" id="Salve" value="Impressão" />
  <input type="submit" name="apar" id="apar" value="Aparelhos de exames" />
  <p><label>Informações encontradas:</label>&nbsp;</p>
  <p>
    <?php
	if(isset($_POST['apar'])) 
  			{
			$busca= "WKE";
					$resposta = $ICB-> apar_wke($busca);
			}
            if(isset($_POST['visual'])) 
  			{
				$resposta = $ICB-> lista($campo,$busca,$nivel,$tipo_t);
				}
			 if(isset($_POST['Salve'])) 
  			{
			$_SESSION['IMPRESSAO'] = "REDE";
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
					$_SESSION['exec'] = $_POST['txtloc'];
					$_SESSION['pesq'] = $campo;
					header('Location: impressao_impr.php');	
   			 }
?>
  </p>
 
  <p>&nbsp;</p>
</form>
</body>
</html>
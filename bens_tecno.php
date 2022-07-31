<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require("./class/class.cst.php");
require("./conectar.php");
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
}else{				#keys
		$id_cod=$_SESSION['ID_COD'];
		$id_nf = $_SESSION['NF'];
		$id_tip =$_SESSION['TIP'];
		$id_situa = $_SESSION['SITUA'];
		$CNPJ = $_SESSION['CNPJ'];
}
?>
</p>
<p align="center"><span class="style6">CADASTRO TECNOLOGIA</span><em>
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
    <?php 
 echo "<p><font color=blue>CNPJ:</font><font color=red> $CNPJ </font><font color=blue>| NFe: </font><font color=red> $id_nf </font><font color=blue>| TIPO:</font><font color=red> $id_tip</font> <font color=blue>| SITUAÇÃO:</font></font><font color=red> $id_situa</font><font color=blue> | Patrimônio:</font> <font color=red>$id_cod </font></p>"; 
  ?>
  <p><img src="img/fv_02 cópia.png" alt="wwww" name="teste" width="1435" height="13" align="top" id="teste2" /></p>
  <p><em>
    <label for="IP"></label>
    <label for="label2"></label>
  </em><em>Marca :
  <input name="TEAM" type="text" id="TEAM" size="40" maxlength="10" value="<?php echo $team; ?>"/>
  <label for="label2"> Modelo:</label>
  <input name="RAM" type="text" id="RAM" size="39" maxlength="4" value="<?php echo $ramal; ?>"/>
  </em><em>
  <label for="label2"></label>
  </em><em>  </em><em>
  <label for="label2">IP :</label>
  <select name="ips" id="ips">
   <option ></option>
   <option>SEM DESCRIÇÃO</option>
 	 <?php
	  	$sql = mysqli_query("SELECT * FROM `red_tel` where 1 order by ip ASC");
	 		 while($monta = mysqli_fetch_assoc($sql))
		  {
			
				echo '<option value="'.$monta['ip'].'">'.$monta['ip'].'</option>';
		  }
      ?>
  </select>
  </em><em>
  <label for="label3">HOSTNAME:</label>
  <select name="pc" id="pc">
  <option ></option>
  <option>SEM DESCRIÇÃO</option>
   		<?php
	  	$sql = mysqli_query("SELECT * FROM `red_tel`  where 1 order by host asc");
	 	 while($monta = mysqli_fetch_assoc($sql))
		  {
			echo '<option value="'.$monta['host'].'">'.$monta['host'].'</option>';
		  }
      ?>
    </select>
  
  </select>
  </em></p>
  <p><em>
    <label for="label2">Processador:</label>
    <select name="proc" id="proc">
     <option></option>
   		 <option>SEM DESCRIÇÃO</option>
      <option>I9</option>
      <option>I7</option>
      <option>I5</option>
      <option>I3</option>
      <option>Quad Core</option>
      <option>Duo Core</option>
      <option>Pentium </option>
      <option>Celeron</option>
      <option>Threadripper AMD</option>
      <option>Ryzen 7</option>
      <option>Ryzen 5 </option>
      <option>Ryzen 3 </option>
      <option>FX AMD</option>
      <option>Athlon</option>
      <option>Athlon X4</option>
    </select>
    <label for="label2">Memoria :</label>
    <select name="memo" id="memo">
     <option></option>
     <option>SEM DESCRIÇÃO</option>
      <option value="1GB">1GB</option>
      <option value="2GB">2GB</option>
      <option value="3GB">3GB</option>
      <option value="4GB">4GB</option>
      <option value="6GB">6GB</option>
      <option value="8GB">8GB</option>
      <option value="10GB">10GB</option>
      <option value="12GB">12GB</option>
      <option value="16GB">16GB</option>
      <option value="32GB">32GB</option>
      <option value="64GB">64GB</option>
      <option value="128GB">128GB</option>
      <option value="256GB">256GB</option>
    </select>
    <label for="label2">HD:</label>
    <select name="hds" id="hds">
     <option></option>
     <option>SEM DESCRIÇÃO</option>
      <option value="120GB">120GB</option>
      <option value="250GB">250GB</option>
      <option value="320GB">320GB</option>
      <option value="500GB">500GB</option>
      <option value="750GB">750GB</option>
      <option value="1TB">1TB</option>
      <option value="2TB">2TB</option>
      <option value="3TB">3TB</option>
      <option value="4TB">4TB</option>
      <option value="6TB">5TB</option>
      <option value="8TB">6TB</option>
      <option value="8TB">7TB</option>
      <option value="8TB">8TB</option>
      <option value="8TB">9TB</option>
      <option value="10TB">10TB</option>
    </select>
    <label for="OBSER">Descr. adicionais:</label>
</em><em>
<select name="descri" id="descri">
</select>
</em><em>
    <label for="label2"></label>
  </em></p>
  <p><em>
    <label for="label2"></label>
  </em><em>
  <label for="OBSER"></label>
  </em><em>
  <label for="OBSER">
  <input type="submit" name="Salvar" id="Salvar" value="Novo/Alterar" />
  <input type="submit" name="del" id="del" value="Delete" />
  </label>
  </em></p>
  <p><em>
    <label for="OBSER"></label>
  </em><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
  <p><em>
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
  </em></p>
  <p><em>
    <label for="DEP"></label>
    <label for="label2"></label>
  </em><em>
  <label for="label2"></label>
  </em><em>
  <label for="OBSER"></label>
  </em></p>
  <p><em>
    <label for="RESP"></label>
    <label for="label2"></label>
    <label for="OBSER"></label>
  </em><em>
  <label for="OBSER"><br />
    </label>
  </em></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><em>
    <label for="NOME PC"></label>
  </em></p>
</form>
</body>
</html>
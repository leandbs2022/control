<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
#conexão do banco e declaração das classes
require("./conectar3.php");
require("./class/class.conv.php");
$itens = new conv;
#Variaveis cadastro
$conv= "";
$status= "";
$paciente= "";
$matricula= "";
$guia= "";
$infor= "";
$proc= "";
$olho = "";
$medic= "";
$data="";
$datini = "";
$datfim = "";
$max = "0";
$min = "0";
$resultado = "";
#variaveis de pesq.
$at= "";
$campo ="";
$busca = "";
$id = "0";
#Variaveis Globais
session_start();
#pesquisa global
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
$_SESSION['numero']= "";
#usuarios acesso
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$depart =$_SESSION['depart'];
?>
<title>Cadastro de covênios</title>
<span id='topo'></span>
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
</em><span class="style6">Status de Paciêntes</span>	<em>
  <?php
  if(isset($_POST['vol'])) 
  		{
			header('Location: perfil_conv.php');
		}
 if(isset($_POST['status'])) 
  	{
	$data = str_replace("/", "-", $_POST['dat']);
    $data= date('Y-m-d', strtotime($data));
	$busca =  $_POST['nom'];
	$descri = $_POST['cmbnom'];
	switch ($descri)
		{
			case 0:
				$campos = "paciente";
			break;
			case 1:
				$campos = "id";
			break;
		}
	
	$query = mysqli_query("SELECT * FROM `status` WHERE  $campos='$busca' and data='$data' ");
	if(mysqli_num_rows($query))
		{
		while($array = mysql_fetch_row($query)) 
				{		
					$status=$array[0];
					$paciente= $array[1];
					$conv= $array[2];
					$matricula= $array[3];
					$proc= $array[4];
					$medic= $array[5];
					$olho = $array[6];
					$data= $array[7];
					$guia= $array[8];
					$infor= $array[9];
				}
		}else{
			
		}
	}
?>
</em></p>
<p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
<form id="form1" name="form1" method="post" action="" >
  <p>  
    <label for="CNPJ"></label><em>
    Convênio
    <label for="label2"></label>
    :
    <input name="conv" type="text" class="Leandro" id="conv" value="<?php echo $conv; ?>" size="40" maxlength="30"/>
    Paciênte
    </em><em>
    <label for="label2">:</label>
    
  <input name="pac" type="text" class="auto" id="pac" value="<?php echo $paciente; ?>" size="75"/>
  </em></p>
  <p><em>Status: 
      <select name="sta" id="sta">
        <option value="SELECIONE">SELECIONE</option>
        <option value="NEGADO">NEGADO</option>
        <option value="PARCIAL">PARCIAL</option>
        <option value="CANCELADO">CANCELADO</option>
        <option value="AUTORIZADO">AUTORIZADO</option>
        <option value="AGUARDANDO">AGUARDANDO</option>
          </select>
    <label for="label2">Matr.:</label>
      <input name="mat" type="text" id="mat" size="15" maxlength="20" value="<?php echo $matricula; ?>"/>
  </em><em>Procedimento:
  <input name="proc" type="text" id="proc" value="<?php echo $proc; ?>" size="30" maxlength="30"/>
  Médico
  </em><em> 
  <label for="label2">:</label>
  <input name="med" type="text" class="Leandro" id="med" value="<?php echo $medic; ?>" size="33" maxlength="40"/>
  </em><em>
  <label for="label2"></label>
  </em></p>
  <p><em>
    <label for="label2">Olho:</label>
    <input name="olh" type="text" id="olh" size="15" maxlength="15" value="<?php echo $olho; ?>"/>
  </em><em>Guia:
  <input name="gui" type="text" id="gui" value="<?php echo $guia; ?>" size="30" maxlength="30"/>
  </em>Data:
  <input type="text" name="date" id="date" value="<?php echo $data; ?>"  />
  </p>
  <p><em>
    <label for="label2"></label>
  </em><em>
<label for="label2"></label>
  </em><em>
  <label for="label2"><span class="style11">Informações Opicionais</span></label>
  <span class="style12">
  <label for="label2"></label>
  </span></em><br />
  <label></label>
</p>
  <p><em>
    <input name="infor" type="text" class="Leandro" id="infor" value="<?php echo $infor; ?>" size="130" />
  </em></p>
  <p><em>
    <input type="submit" name="Salvar" id="Salvar" value="Novo/Alterar" />
    <input type="submit" name="status" id="status" value=" Localizar Status do Paciênte" />
    <select name="cmbnom" id="cmbnom">
      <option value="0">Paciênte</option>
      <option value="1">Reg</option>
    </select>
    <input name="nom" type="text" id="nom" size="40" />
    Data:
    <input name="dat" type="text" id="dat" size="15" />
    <?php
	
if(isset($_POST['Salvar'])) 
  	{			
		$status = $_POST['sta'];
		$paciente = $_POST['pac'];
		$conv = $_POST['conv'];
		$matricula= $_POST['mat'];
		$proc = $_POST['proc'];
		$medic= $_POST['med'];
		$olho = $_POST['olh'];
		$guia = $_POST['gui'];
		$infor =  $_POST['infor'];
		$data = str_replace("/", "-", $_POST['date']);
    	$data = date('Y-m-d', strtotime($data));
		if($depart == 4 or $depart == 7)
			{
				$resposta = $itens-> adicionar_status($status,$paciente,$conv,$matricula,$proc,$medic,$olho,$data,$guia,$infor);
			}
			else
			{
				echo "<b><font color=red>Você não tem permissão de salvar ou alterar dados!!!</font></b>"; 
			}
	}
	?>
    
  </em></p>
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
  </em><em><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></em></p>
  <em>
  <p>
    <label></label>
    <em>
    <label for="infor"><a href="perfil_conv.php" title="Convênios"></a>
   
    data inicio:
    <input name="dtini" type="text" id="dtini" size="15"  />
    data final:</label>
    <em>
    <input name="dtfim" type="text" id="dtfim" size="15" />
    </em>    <em>
    <input type="submit" name="Localizar" id="Localizar" value="Localizar" />
    <em><em>
    <input type="submit" name="vol" id="vol" value="Convênio" />
    </em></em></em>
    <label for="infor"></label>
    <label for="infor"><br />
    </label>
    <em>
    <?php
	
		if(isset($_POST['Localizar'])) 
  		{
			
			$datini = str_replace("/", "-", $_POST['dtini']);
    		$datini = date('Y-m-d', strtotime($datini));
			
			$datfim = str_replace("/", "-",  $_POST['dtfim']);
    		$datfim = date('Y-m-d', strtotime($datfim));
			
			
			if (empty($datini) || empty($datfim) ){
				echo "Digite as datas!!!!";
			}
			else{
				$resposta = $itens-> lista_data($datini,$datfim);
			}
		}
	?>
    </em>
    <label for="infor"><br />
    <br />
    <br />
    </label>
    </em></p>
  </em>
</form>
</body>
</html>
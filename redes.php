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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Cadastro de dados</title>
<span id='topo'></span>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<body background="">
	<div class="container">
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
<em>
<?php
  
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
					if($_POST['txtloc'] <> ""){header('Location: impressao_impr.php');}	

   			 }
 if(isset($_POST['LOC'])) 
  	{
		
		if($_POST['txtloc'] <> ""){
		$busca =  $_POST['txtloc'];
		$descri= $_POST['pes'];
		switch ($descri) 
			{
    			case 0:
        			$campo = "ram";
       			break;
    			case 1:
        			$campo = "host";
        		break;
				case 2:
        			$campo = "dep";
        		break;
				case 3:
        			$campo = "resp";
        		break;
				case 4:
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
									$pc  = $array[0];
									$dep  = $array[1];
									$resp = $array[2];
									$team  =$array[3];
									$ramal= $array[4];
									$carg = $array[5];
									$loc = $array[6];
									$desc= $array[7];
									$cnpj= $array[8];
								}
						}
				}
				}else{
						
	
			}
	}
	
?>
</em>
<form id="form1" name="form1" method="post" action="" >
	<p>
	  <input name="voltar" type="submit" class="btn btn-secondary btn-sm" id="voltar" formaction="inicial.php" value="VOLTAR"  align="right"/>
	</p>
	<div class="" role="alert">
	  <h1 align="left">INFORMAÇÕES</h1>
	</div>
	<p><h6>
        Computador:
      <p><input name="HOST" type="text" class="Leandro" id="HOST" maxlength="15" size="50" value="<?php echo $pc; ?>"/></p>
      Depar:
	  <p> <select name="DEP" id="DEP" value="<?php echo $dep; ?>">
	          <option ><?php echo $dep; ?></option>
	          <?php
		$sql = mysqli_query("SELECT dep FROM depart");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['dep'].'">'.$monta['dep'].'</option>';
      }
      ?>
            </select> </p>
	        Usuário:
			<p><input name="RESP" type="text" class="Leandro" id="RESP" size="25" maxlength="20" value="<?php echo $resp; ?>"/> </p>
     
AnyDesk :
<p><input name="TEAM" type="text" id="TEAM" size="20" maxlength="10" value="<?php echo $team; ?>"/> </p>
 Ramal:
  <input name="RAM" type="text" id="RAM" size="15" maxlength="4" value="<?php echo $ramal; ?>"/>
  </em><em>
  Local:
  <input name="LOC2" type="text" class="Leandro" id="label" size="45" maxlength="15" value="<?php echo $loc; ?>"/>
Função :
  <input name="CARGO" type="text" class="Leandro" id="CARGO" size="26" maxlength="15" value="<?php echo $carg; ?>"/>
 <br>
 <br>
 Informação Adicional:
	<p></p>
	<p></p>
	<p> <input name="OBSER" type="text" class="Leandro" id="OBSER" value="<?php echo $desc; ?>" size="120" /> </p>
  </h6>
	<h6>
	  <input type="submit" name="Salvar" id="Salvar" class="btn btn-secondary btn-sm" value="Novo/Alterar" />
	  <input type="submit" name="del" id="del" class="btn btn-secondary btn-sm" value="Delete" />
	  <?php 
	if(isset($_POST['Salvar'])) 
  	{	
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
		$resposta = $ICB-> adicionar($pc,$dep,$resp,$team,$ramal,$carg,$loc,$desc);
		}
	}
	 
	if(isset($_POST['del'])) 
  	{
	$pc = $_POST['HOST'];
		if($nivel <> 2){
				echo "Voce nao tem permissao de excluir dados!!!";
		}
		else
		{
		$resposta = $ICB-> delete($pc);
		}
	}
	?></p>
    </h6>
  <div class="" role="alert">
    <h1 align="left">RESUMO</h1>
  </div>
  <p><em>
    <label for="RESP"></label>
    <label for="label2"></label>  
    <label for="OBSER"></label>
    <label>Tipo:</label>
    <label></label>
    <select name="pes" id="pes">
      <option value="1">RAMAL</option>
      <option value="2">PC</option>
      <option value="3">DEPART</option>
      <option value="4">USUARIO</option>
      <option value="5">LOCAL</option>
    </select>
    <label>Dig:</label>
    <input name="txtloc" type="text" class="Leandro" id="txtloc" onchange="return bar()"/>
    <input type="submit" name="LOC" id="LOC" class="btn btn-success btn-sm" value="Localizar" />
    <input type="submit" name="Salve" id="Salve" class="btn btn-secondary btn-sm" value="Impressão" />
    <input type="submit" name="visual" id="visual" class="btn btn-success btn-sm" value="Visualizar dados" />
    <label for="Salvar xls"></label>
    <label for="OBSER"><br />
  </label>
</em></p>
  <p>&nbsp;
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
?>
  </p>
  <script > 
    var idleTime = 0;
    $(document).ready(function () {
    //Increment the idle time counter every minute.
    if($('iframe').length < 1) // caso não exista iframe vamos incrementar o contador (idleTime) de 1 em 1 minuto
        var idleInterval = setInterval(timerIncrement, 60000); // 1 minutos

    // resetamos o contador caso sejam detetados estes eventos
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
    $(window).on('scroll', function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 14) { // 15 minutes
      document.location.href = "index.php";
    }
}
</script>
</form>
	</div>
</body>
</html>
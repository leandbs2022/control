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
$user= "";
$pass= "";
$contato= "";
$guia= "";
$infor= "";
$link= "";
$descri="";
$max = 0;
$min = 0;
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
</em><span class="style6">CADASTRO DE CONVENIOS </span>	<em>

  <?php
  if(isset($_POST['cad'])) 
  			{
			   if($depart == 4 or $depart == 7)
					{
						header('Location: status_conv.php');				
					}
					else
					{
						#echo "<b><font color=red>Você não tem permissão de cadastro somente pessoal autorizado!!!</font></b>"; 
					}
			
			}
 if(isset($_POST['LOC'])) 
  	{
	$busca =  $_POST['pes'];
	$query = mysqli_query("SELECT * FROM `acessos` WHERE  conv='$busca' ");
	if(mysqli_num_rows($query))
		{
		while($array = mysql_fetch_row($query)) 
				{		
					
					$conv= $array[0];
					$user= $array[1];
					$pass= $array[2];
					$contato= $array[3];
					$guia= $array[4];
					$infor= $array[5];
					$link= $array[6];
				}
		}
	}
?>
</em>

</p>
<p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
<form id="form1" name="form1" method="post" action="" >
  <p>  
    <label for="CNPJ"></label><em>
    Convênio
    <label for="label2"></label>
    :
    <input name="conv" type="text" class="Leandro" id="conv" value="<?php echo $conv; ?>" size="30" maxlength="30"/>
    URL</em><em>_Aut
    <label for="label2">:</label>
  <input name="link" type="text" class="auto" id="link" value="<?php echo $link; ?>" size="85"/>
  </em></p>
  <p><em>Uusário: 
      <input name="usua" type="text" id="usua" size="15" maxlength="25" value="<?php echo $user; ?>"/>
      <label for="label2">Senha:</label>
      <input name="sen" type="text" id="sen" size="15" maxlength="15" value="<?php echo $pass; ?>"/>
  </em><em>Contato_conv:
  <input name="cont" type="text" id="cont" value="<?php echo $contato; ?>" size="30"/>
  </em><em>
 Guia 
 <label for="label2">:</label>
  <input name="gui" type="text" class="Leandro" id="gui" value="<?php echo $guia; ?>" size="29" maxlength="40"/>
  </em><em>
  <label for="label2"></label>
  </em></p>
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
    <textarea name="infor" cols="142" class="Leandro" id="infor"><?php echo $infor; ?></textarea>
  </em></p>
  <table width="1004" border="0">
    <tr>
      <th width="92" height="28" scope="col"><em>
        <input type="submit" name="Salvar" id="Salvar" value="Novo/Alterar" />
      </em></th>
      <th width="141" scope="col"><em>
        <input type="submit" name="LOC" id="LOC" value="Localizar Convênio" />
      </em></th>
      <th width="375" scope="col"><div align="left"><em>
        <select name="pes" id="pes">
          <?php
      $sql = mysqli_query("SELECT conv FROM `acessos` where 1");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['conv'].'">'.$monta['conv'].'</option>';
      }
	 ?>
        </select>
        <?php
	
if(isset($_POST['Salvar'])) 
  	{			
		$conv= $_POST['conv'];
		$user= $_POST['usua'];
		$pass= $_POST['sen'];
		$contato= $_POST['cont'];
		$guia= $_POST['gui'];
		$infor= $_POST['infor'];
		$link= $_POST['link'];
		if($depart == 4 or $depart == 7)
			{
				$resposta = $itens-> adicionar_conv($conv,$user,$pass,$contato,$guia,$infor,$link);
			}
			else
			{
				echo "<b><font color=red>Você não tem permissão de salvar ou alterar dados!!!</font></b>"; 
			}
	}
	?>
      </em></div></th>
      <th width="16" scope="col">&nbsp;</th>
      <th width="16" scope="col">&nbsp;</th>
      <th width="16" scope="col">&nbsp;</th>
      <th width="185" scope="col">&nbsp;</th>
      <th width="129" scope="col">&nbsp;</th>
    </tr>
  </table>
  <p><em><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></em></p>
  <table width="1004" border="0">
    <tr>
      <th width="10" height="50" scope="col">&nbsp;</th>
      <th width="13" scope="col">&nbsp;</th>
      <th width="432" scope="col"><div align="left"><em>
        <input type="submit" name="Loca" id="Loca" value="Visualizar um  Convênio" />
        <input type="submit" name="visual" id="visual" value="Visualizar Todos os  Conv." />
        <select name="pes2" id="pes2">
          <?php
      $sql = mysqli_query("SELECT conv FROM `acessos` where 1");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['conv'].'">'.$monta['conv'].'</option>';
      }
	 ?>
        </select>
      </em></div></th>
      <th width="16" scope="col">&nbsp;</th>
      <th width="12" scope="col">&nbsp;</th>
      <th width="417" scope="col"><div align="right"><em>
        <select name="cmbc" id="cmbc">
          <option value="0">Paciênte</option>
          <option value="1">Data</option>
        </select>
        <input type="submit" name="status" id="status" value=" Localizar Status Paciênte" />
        <input type="submit" name="cad" id="cad" value="Cadastro de Status" />
        <input name="dat" type="text" id="dat" size="50" />
      </em></div></th>
      <th width="21" scope="col">&nbsp;</th>
      <th width="49" scope="col">&nbsp;</th>
    </tr>
  </table>
  <p><em>
    <img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" />
    <label><br />
    Informações: </label>
  </em><em>
  <?php
        
	   if(isset($_POST['visual'])) 
  			{
				$resposta = $itens-> lista_conv($busca);
			}
		if(isset($_POST['Loca'])) 
  			{
				$busca =  $_POST['pes2'];
				$resposta = $itens-> lista_conv($busca);
			}
		 if(isset($_POST['status'])) 
  			{
				$busca = $_POST['dat'];
				$descri= $_POST['cmbc'];
				switch ($descri) 
					{
    					case 0:
       					$campos = "paciente";
        				break;
    					case 1:
        				$campos = "data";
						$busca = str_replace("/", "-", $_POST['dat']);
    					$busca = date('Y-m-d', strtotime($busca));
						break;
					}
				$resposta = $itens-> lista_status($busca,$campos);
			}
?>
  </em></p>
  <table width="1347" border="0">
    <tr>
      <th width="1297" scope="col"><div align="left"></div></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p><em>
    <label></label>
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
  </em><em>
  <label></label>
  </em></p>
  <em>
<p>
    <label></label>
    <label></label>
    <label></label>
  </p>
  <p>&nbsp;</p>
  <p>
    <label for="Salvar xls"></label>
    <label></label>
    <label></label>&nbsp;</p>
  </em>
  <p>
    <label></label>
  </p>
  <em>
  <label for="label2"></label>
  </em>
  <label></label><p><br />
  </p>
</p>
  <label></label>
  <p><em>
    <label for="DEP"></label>
    <label for="label2"></label>
  </em><em>
  <label for="RESP"></label>
    <label for="label2"></label>  
    <label for="infor"></label>
    <label for="infor"><br />
    </label>
  </em></p>
</form>
</body>
</html>
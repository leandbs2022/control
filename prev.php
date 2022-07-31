<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require("./conectar.php");
require("./class/class.forn.php");
require("./class/class.prev.php");
$prev = new serv;
$id = 0;
$empr = "";
$tel  = "";
$contato = "";
$cnpj = "";
$descri= "";
$obs= "";
$NF= "";
$val="";
$ativa = 1;
$encontra = "";
$link_f = false;
session_start();
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
#$_SESSION['utilizador'] = "ICB";
#$_SESSION['nivel'] =1;
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$_SESSION['tipo_T']="Re";
$tipo_t = $_SESSION['nivel'];
$data = "";
$busca = $_SESSION['ID'];
$userid = $_SESSION['ID'];
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
.style9 {
	color: #3333FF;
	font-weight: bold;
}
.style10 {
	color: #CC0099;
	font-style: italic;
	font-weight: bold;
}
.style11 {
	color: #0033FF;
	font-style: italic;
}
.style12 {color: #FF0000}
-->
</style>
</head>

<body background="">
<p align="center"><em>
  <label for="teste"></label>
</em><em><span class="style6">
<?php
if($_SESSION['nivel'] <> 2)
{
	header('Location: BLOQUEIO.php');
}else{
		
}	
?>
PRESTAÇÃO DE SERVIÇOS</span></em></p>
<p><img src="img/fv_02 cópia.png" alt="wwww" name="teste" width="1435" height="13" align="top" /></p>
<form id="form2" name="form2" method="post" action="">
  <em>
  Empresas:
  <select name="cmbfor" id="cmbfor">
    <option value="0"></option>
	<?php
      $sql = mysqli_query("SELECT emp FROM forne_terc order by emp asc");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['emp'].'">'.$monta['emp'].'</option>';
      }
	 ?>
  </select>
  <input type="submit" name="loc" id="loc" value="Busca" />
  <?php 
  		if(isset($_POST['nfe'])) 
			{
				$valor = $_POST['val'];
				settype ($valor, 'float');
			}
	if(isset($_POST['loc'])) 
		{
			$nome=$_POST['cmbfor'];
			$sql=mysqli_query("SELECT * FROM `forne_terc` WHERE emp='$nome'");
			if(mysqli_num_rows($sql))
					{
					while($array = mysql_fetch_row($sql)) 
						{		
							
							$cnpj = $array[2];
							$ativa = $array[12];
							if($cnpj == 0)
							{
								echo "<b><font color=red>Fornecedor sem CNPJ cadastre em menu fornecedores antes de continuar!!! </font></b>";
							}else{
									if($ativa == 1){	
										$id = $array[0];
										$empr = $array[1];
										$tel  = $array[3];
										$contato = $array[4];
										$cnpj = $array[2];
										
										$_POST['cnpj']=$cnpj;
										$cor = "";
										$obser = "";
											if($cnpj == 0){
													$cor = "red";
													$obser = "Favor cadastrar o CNPJ da empresa no menu fornecedores!!!!";
												}else{
													$cor = "green";
													$obser = "OK";
											}
										echo "<b><font color=$cor> CNPJ: {$cnpj} - $obser </font></b>";
										}else{
											echo "<b><font color=red> Empresa encotra-se desativada favor ativa-la para poder cadastrar serviços!!! </font></b>";
										}
							}
						}
					}
		}
  ?>
  </em>
</form>
<form id="form1" name="form1" method="post" action="" >
  <p>  
    <label for="CNPJ"></label><em>
    <label for="label2"></label>
  </em><span class="style10"><span class="style12">Dados da empresa</span></span></p>
  <p><em> ID_Forn:
    <input name="idfor" type="text" id="idfor" size="3" maxlength="3" readonly="True" value="<?php echo  $id ; ?>"/>
  </em>Empresa:
    <input name="empr" type="text" id="empr" value="<?php echo $empr; ?>" size="80" readonly="True"/>
    Telefone:
    <input type="text" name="tel" id="tel" readonly="True" value="<?php echo $tel; ?>"/>
  Contato:
  <input type="text" name="Cont" id="Cont" readonly="True" value="<?php echo $contato; ?>"/>
  
  <p class="style9">Cadastro de Serviço
  <p><em>
    <label for="label2">CNPJ:
    <input name="cnpj" type="text" id="cnpj" value="<?php echo $cnpj; ?>" size="15" readonly="True"/>
    Data:</label>
    <input name="DT" type="date" class="Leandro" id="DT" value="<?php  echo $data; ?>" size="10" maxlength="12"/>
  </em><em>
  <label for="label2"> Descrição:</label>
  <input name="descr" type="text" class="Leandro" id="descr" value="<?php  echo $descri; ?>" size="50"/>
  </em><em>
  <label></label>
  </em>
  <label></label>
Valor:
<input name="val" type="TEXT" id="val" size="15" value="<?php echo  $val; ?>"maxlength="15" />
Vincular nota:
<input name="nf_prev" type="text" id="nf_prev" value="<?php echo $NF; ?>" size="15"/>
  <p><em>
    <label for="IP"></label>
    <label for="label2"></label>
  </em><span class="style11">
  <label for="label"><strong>Serviço Prestado:</strong></label>
  </span></p>
  <p><em>
    <label for="NOME PC"></label>
  </em><em>
  <label for="label"></label>
  </em><em>
  <textarea name="OBSER" cols="150" rows="2" class="Leandro" id="OBSER"><?php echo $obs; ?></textarea>
  </em></p>
  <p><em>
    <label for="descr"></label>
    <label for="label2"></label>  
    <label for="OBSER"></label>
    <input type="submit" name="Salvar" id="Salvar" value="Adicionar serviço prestado" />
    <input type="submit" name="Vi" id="Vi" value="Dados NFe" />
    <select name="cmbnf" id="cmbnf">
     <?php
      $sql = mysqli_query("SELECT  id_nf,cnpj FROM prev where cnpj='$cnpj'");
      if(mysqli_num_rows($sql))
		{
			 while($monta = mysqli_fetch_assoc($sql))
				  {
					 echo '<option value="'.$monta['id_nf'].'">'.$monta['id_nf'].'</option>';
				  }
	  	}
	 ?>
    </select>
  </em></p>
  <p><em>
    <label for="OBSER"><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></label>
    <input type="submit" name="visualizar" id="visualizar" value="Visualizar todos os registros da empresa" />
    <label for="OBSER"><br />
    </label>
    <label for="OBSER"><br />
    </label>
    <?php
	if(isset($_POST['visualizar'])) 
			{
					$cnpj = $_POST['cnpj'];
				$respo=$prev->lista_prev($cnpj);
			} 
  if(isset($_POST['Salvar'])) 
			{
				$descri = $_POST['descr'];
				$data= $_POST['DT'];
				$obs= $_POST['OBSER'];
				$NF= $_POST['nf_prev'];
				$val= $_POST['val'];
				$cnpj= $_POST['cnpj'];
				if(empty($cnpj)){
						echo "<b><font color=red> CNPJ em branco favor selecione alguma empresa !!!!  </font></b>";
						}else{
						$respo=$prev->adicionar_prev($descri,$data,$obs,$cnpj,$NF,$val);
					}
			}		
		 if(isset($_POST['Vi'])) 
			{
				if(empty($_POST['cmbnf'])){
					echo "<b><font color=red> Não existe nota fiscal a ser visulizada ou impressa!!!!  </font></b>";
				}else{
						$link = $_POST['cmbnf'];
						$_SESSION['exec'] = $link;
						if(empty($link)){
							echo "<b><font color=red> Não existe nota fiscal para esse prestador de serviço neste registro!!! </font></b>";
						}
						else
						{
								$sql=mysqli_query("SELECT * FROM `prev` WHERE id_nf='$link'");
									if(mysqli_num_rows($sql))
									{
										while($array = mysql_fetch_row($sql)) 
										{		
											$descri = $array[0];
											$data = $array[1];
											$obs = $array[2];
											$cnpj = $array[3];
											$NF = $array[4];
											$val = $array[4];
											echo "<b><font color='#298A08'> Data: $data | Descrição: $descri | Manutenção: $obs </font></b>";
											echo "<p></p>";
											echo "<a href=nfe_imp.php> Imprimir nota fiscal </a>";
											#echo "<img src=img/Prev_NFe/$link.jpg width=720 height=1080 alt= descrição da imagem/>";
										}
									}
						}
					}
			}
  ?>
    <label for="OBSER"><br />
    </label>
  </em></p>
</form>
</body>
</html>
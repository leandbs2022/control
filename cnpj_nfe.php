<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
#conexões
require("./class/class.invent.php");
require("./conectar2.php");
$ICB = new invent;
#variaveis Globais
session_start();
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
$_SESSION['impressao']="";
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$_SESSION['tipo_T']="Re";
$tipo_t = $_SESSION['nivel'];
#keys
$id_cod= 0;
$id_nf = 0;
$id_tip =0;
$id_situa = 0;
#variaveis cad_prod
$marc = "";
$modelo ="";
$dep  = "";
$desc="";
$tip_prod= "";
$situa= "";
#variaveis nota fiscal
$id_nfe="";
$dt_gar ="";
$dt_comp = "";
$nf_desc = "";
$link = "";
#variaveis empresa
$cnpj = "";
$ins_est = "";
$fant = "";
$end = "";
$cid = "";
$bai = "";
$cep ="";
$tel = "";
$uf = "";
#variaveis secudarias
$loc = "";
$campo = "";
$pesq = "";
$hidden = "toggle";
?>
<title>Inventario</title>
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
	color: #0033FF;
	font-weight: bold;
}
-->
</style>
</head>

<body background="">
<p align="center"><em>
  <label for="teste"></label>
</em>
  <?php
#$datedia = date('d/m/Y');
if($_SESSION['nivel'] <> 2)
{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>" ;
	header('Location: BLOQUEIO.php');	 
}else{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ; 
	
}

if(isset($_POST['loc_emp'])) 
  			{	
			
				$cnpj= $_POST['cmbemp'];
				$query = mysqli_query("SELECT * FROM `empre` WHERE  cnpj='$cnpj'");
					if(mysqli_num_rows($query))
						{
						
							while($array = mysql_fetch_row($query)) 
								{		
									$cnpj = $array[0];
									$ins_est = $array[1];
									$fant  = $array[2];
									$end  = $array[3];
									$cid  =$array[4];
									$bai = $array[5];
									$cep= $array[6];
									$uf = $array[7];
									$tel = $array[8];
								}
				
						}
		}
		
?>
  INVENTARIO CADASTRO</p>
<p align="left">
  <input type='button' value='Voltar para Inventario' onclick="javascript: location.href='inventario.php';" />
</p>
<p><img src="img/fv_02 cópia.png" alt="wwww" name="teste" width="1435" height="13" align="top" /></p>
<form id="form1" name="form1" method="post" action="" >
<p></p>
<p class="style9">Cadastro da Empresa</p>
<table width="1346" border="0" align="center">
    <tr>
      <td width="1431"><p>
          <label for="CNPJ">CNPJ</label>
        :<em>
          <input name="CNPJ" type="number" id="CNPJ" maxlength="14" tipo="number" value="<?php echo $cnpj; ?>"/>
          <label for="label2">Inscr_Estadual</label>
          :
          <input name="estadual" type="number" id="estadual" maxlength="15" value="<?php echo $ins_est; ?>"/>
          <label for="label2">Nome_Fantasia:</label>
          <input name="fantasia" type="text" class="Leandro" id="fantasia" value="<?php echo $fant; ?>" size="50" maxlength="255"/>
          </em><em>
            <label for="label2">Telefone :</label>
            <input name="Telefone" type="number"  class="Leandro" id="Telefone" size="15" maxlength="15" value="<?php echo $tel; ?>"/>
          </em></p></td>
    </tr>
    <tr>
      <td><em>
        <label for="label2">End.:</label>
        <input name="endereço" type="text" class="Leandro" id="endereço" size="50" maxlength="255" value="<?php echo $end ; ?>"/>
        Cidade :
        <input name="cidade" type="text" id="cidade" size="15" maxlength="30" value="<?php echo $cid; ?>" />
        </em><em>
        <label for="label2">Bairro:</label>
        <input name="bairro" type="text" id="bairro" value="<?php echo $bai; ?>" size="15" maxlength="30"/>
        <label for="label2">UF:</label>
        <input name="UF" type="text" class="Leandro" id="label" value="<?php echo $uf; ?>" size="10" maxlength="2"/>
        </em><em>
        <label for="label2"></label>
        </em><em> </em><em>
        <label for="label2"></label>
        </em><em>
        <label for="label2">Cep:</label>
        <input name="cep" type="number" class="Leandro" id="cep" value="<?php echo $cep; ?>" size="10" maxlength="8"/>
        </em></td>
    </tr>
  </table>
  <p>
    <em>
    <input type="submit" name="Salvar_empresa" id="Salvar_empresa" value="Adicionar Empresa" />
    </em>
    <input type="submit" name="alt" id="alt" value="Alterar " />
    <input type="submit" name="loc_emp" id="loc_emp" value="Localizar" />
    <select name="cmbemp" id="cmbemp">
    <?php
	  $sql = mysqli_query("SELECT * FROM `empre` WHERE cnpj ");
	  while($monta = mysqli_fetch_assoc($sql))
		  {
			if(empty($monta)){
				
			}else{
				echo '<option value="'.$monta['cnpj'].'">'.$monta['cnpj'].'</option>';
			 }
		  }
      ?>
    </select>
    <?php 
	if(isset($_POST['Salvar_empresa'])) 
  	{	
			$cnpj= $_POST['CNPJ'];
			$ins_est  = $_POST['estadual'];
			$fant = $_POST['fantasia'];
			$end  = $_POST['endereço'];
			$cid = $_POST['cidade'];
			$bai = $_POST['bairro'];
			$cep  = $_POST['cep'];
			$uf= $_POST['UF'];
			$tel= $_POST['Telefone'];

			if($nivel <> 2){
					echo "Voce nao tem permissao de salvar ou alterar dados!!!";
			}
			else
			{
			$query = mysqli_query("SELECT * FROM `empre` WHERE cnpj='$cnpj'");
			if(mysqli_num_rows($query)){
			echo "<label style=background-color:yellow align=center> Ja existe uma registro com esse cnpj!!!!!!</label>";
			}else{
				$resposta = $ICB-> adicionar_empresa($cnpj,$ins_est,$fant,$end ,$cid,$bai,$cep,$uf,$tel);
				}
				
			}
	}
	
	if(isset($_POST['alt'])) 
  		{	
			$cnpj= $_POST['CNPJ'];
			$ins_est  = $_POST['estadual'];
			$fant = $_POST['fantasia'];
			$end  = $_POST['endereço'];
			$cid = $_POST['cidade'];
			$bai = $_POST['bairro'];
			$cep  = $_POST['cep'];
			$uf= $_POST['UF'];
			$tel= $_POST['Telefone'];
			if($nivel <> 2){
					echo "Voce nao tem permissao de salvar ou alterar dados!!!";
			}
			else
			{
				
				$resposta = $ICB-> alter_em($cnpj,$ins_est,$fant,$end,$cid,$bai,$cep,$uf,$tel);
			}
		}
		
		
	?>
    <label></label>
    <label></label>
  </p>
  <p><em>
    <label for="estadual"></label>
    <label for="label2"></label>
    <label for="label2"></label>
  </em><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
  <p><em>
    <label for="NOME PC"></label>
    <label for="label2"> </label>
    <label for="label2"></label>
  
    <label for="label2"></label>
    <label for="label2"></label>
  </em>
    <span class="style9">Cadastro de Nota</span>
  <table width="1346" border="0" align="center">
    <tr>
      <td width="1431"><p>
          <label for="label3">NFe</label>
        :<em>
          <input name="nf" type="number" id="label3" maxlength="14" tipo="number" value="<?php echo $id_nfe; ?>"/>
          Desc_prod:
          <input name="prod_desc2" type="text" id="prod_desc2" value="<?php echo $nf_desc; ?>" size="130" maxlength="255"/>
          <label for="label4"></label>
        </em></p></td>
    </tr>
    <tr>
      <td><em>
        <label for="label4"> </label>
        </em><em>
        <label for="label4">Comprar:</label>
        <input name="dtcomprar2" type="date" class="Leandro" id="dtcomprar2" value="<?php echo $dt_comp; ?>" size="15" maxlength="10"/>
        <label for="label4">Garantia</label>
        <input name="dtgarantia2" type="date"  class="Leandro" id="dtgarantia2" size="15" maxlength="10" value="<?php echo $dt_gar; ?>"/>
        </em><em>
        <label for="label4">Chave de acesso.:</label>
        <input name="link2" type="text" class="Leandro" id="link2" size="60" maxlength="255" value="<?php echo $link ; ?>"/>
      </em></td>
    </tr>
  </table>
  <p> <em>
    <input type="submit" name="Salvarnf2" id="Salvarnf2" value="Adicionar Nota Fiscal " />
    </em>
      <input type="submit" name="altnf" id="altnf" value="Alterar " />
      <input type="submit" name="loc_nf" id="loc_nf" value="Localizar" />
      <select name="cmbnf" id="cmbnf">
            </select>
      <em>
      <input type="submit" name="notanf" id="notanf" value="Visualizar NFe" />
      </em>
      <label></label>
      <label></label>
      <em>
      <input type="submit" name="imprimir" id="imprimir" value="Impressão NFe" />
      </em>
      <?php 

	if(isset($_POST['Salvarnf'])) 
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
			if($nivel <> 2)
			{
					echo "Voce nao tem permissao de salvar ou alterar dados!!!";
				}else{
					$resposta = $ICB-> adicionar($cnpj,$ip,$pc,$dep,$resp,$team,$ramal,$carg,$loc,$desc);
			}
	}
	if(isset($_POST['notanf'])) 
  		{
	
			echo "<input type=submit name=testeinv id=testeinv hidden=hidden value=Submit/>";
		}
	?>
  </p>
  <p>
    <?php 
		 
		 
			
		  if(isset($_POST['notanf'])) 
			{
					if ($_POST['nf'] == ""){
						echo "Digite o numero ou localize a nota" ;
					}else{
						$link = $_POST['nf'];
						$teste=$_POST['cmbnf'];
						echo "<img src=img/NFe/$link.jpg width=800 height=1080 alt= descrição da imagem/>";
			  		}
		  }
		  
          if(isset($_POST['imprimir'])) 
			{
					if ($_POST['nf'] == ""){
						echo "Digite o numero ou localize a nota" ;
					}else{
						$link = $_POST['nf'];
						$_SESSION['impressao']=$link ;
						header('Location: imagens_imp.php');	
					}		
			}
  ?>
  </p>
  <p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
  <p><em>
    <label for="tip"></label>
    <label for="label2"></label>
    <label for="label2"></label>
  </em>
    <label for="label2"></label>
    <span class="style9">Cadastro de descrições( itens</span>)</p>
  <p><em>Tipo:
      <label for="label4">
      <select name="tip2" id="tip2" value="" required="required">
        <?php
		$sql = mysqli_query("SELECT tip_prod FROM tip");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['tip_prod'].'">'.$monta['tip_prod'].'</option>';
      }
      ?>
      </select>
      </label>
  </em>Descrição do Item:
  <input name="desc" type="text" id="desc" size="100" />
  <input type="submit" name="add" id="add" value="Adicionar descrição" />
  </p>
  <p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /></p>
  <p>
    <label for="label2"></label>
  </p>
  <p>&nbsp;</p>
</form>
</body>
</html>
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
$_SESSION['CNPJ']=0;
$_SESSION['ID_COD']=0;
$_SESSION['TIP']="";
$_SESSION['SITUA']="";
$_SESSION['NF']=0;
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$_SESSION['tipo_T']="Re";
$tipo_t = $_SESSION['nivel'];
$id_cod="";
$id_nf = "";
$id_tip ="";
$id_situa ="";
$CNPJ ="";
#variaveis secudarias
$loc = "";
$campo = "";
$pesq = "";
$hidden = "toggle";
$descri = "";
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
.style9 {font-size: 16px}
-->
</style>
</head>

<body background="">
<p align="center"><em>
  <label for="teste"></label>
</em><?php
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
<span class="style6">INVENTARIO</span> -<strong> EM DESENVOLVIMENTO</strong></p>
<form id="form1" name="form1" method="post" action="" >
  <p>
    <label for="label2"></label><em>
<label for="label4"></label>
    </em>
    <img src="img/fv_02 cópia.png" alt="wwww" name="teste" width="1435" height="13" align="top" />
  
  <table width="1194" border="0" align="center">
    <tr>
      <th width="181" height="44" scope="col"><label for="label2"><em>CNPJ</em></label>
:<em>
<select name="cmbcnpj2" id="cmbcnpj2" required="required" >
  <option ></option>
  <?php
		$sql = mysqli_query("SELECT cnpj FROM empre");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['cnpj'].'">'.$monta['cnpj'].'</option>';
      }
      ?>
</select>
</em></th>
      <th width="140" scope="col"><em>
        <label for="label4">NFe</label>
:
<select name="cmbnfe2" id="cmbnfe2">
 <option></option>
  <?php
		$sql = mysqli_query("SELECT id_nf FROM nf");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['id_nf'].'">'.$monta['id_nf'].'</option>';
      }
      ?>
</select>
      </em></th>
      <th width="290" scope="col"><label for="label2"><em>Patrimônio
        :
            <input name="patri" type="number" class="Leandro" id="patri" value="<?php ?>" size="15" maxlength="15" required/>
<br />
      </em></label>
        <em>
        <label for="label4"></label>
      </em></th>
      <th width="206" scope="col"><em>Tipo:
    <label for="label4">
          <select name="tip2" id="tip2" value="" required>
            <option></option>
            <?php
		$sql = mysqli_query("SELECT tip_prod FROM tip");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['tip_prod'].'">'.$monta['tip_prod'].'</option>';
      }
      ?>
        </select>
        </label>
      </em></th>
      <th width="296" scope="col"><em>
        <label for="label4">Situação:</label>
        <select name="situa2" id="situa2" required>
        <option></option>
          <?php
		$sql = mysqli_query("SELECT situa FROM situac");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['situa'].'">'.$monta['situa'].'</option>';
      }
      ?>
        </select>
      </em>
        <input type="submit" name="conf_bar2" id="conf_bar2" value="Confirmar" />
      <?php 
		 
		 #echo "<a href=bens_inv.php> Cadastro de Bens </a>";
		  if(isset($_POST['notanf'])) 
			{
					if ($_POST['nf'] == ""){
						echo "Digite o numero ou localize a nota" ;
					}else{
						$link = $_POST['nf'];
						$teste= $_POST['cmbnf'];
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
  ?></th>
      <th width="55" scope="col"><p align="left">
        <input type='button' value='Config' onclick="javascript: location.href='cnpj_nfe.php';" />
      </p>      </th>
    </tr>
  </table>
  <p><img src="img/fv_02 cópia.png" alt="wwww" width="1350" height="11" /><?php 
		if(isset($_POST['conf_bar2'])) 
			{
		$id_cod= $_POST['patri'];
		$id_nf = $_POST['cmbnfe2'];
		$id_situa = $_POST['situa2'];
		$CNPJ = $_POST['cmbcnpj2'];
 		$id_tip= $_POST['tip2'];
			
		$_SESSION['CNPJ'] = $CNPJ;
		$_SESSION['ID_COD'] = $id_cod;
		$_SESSION['TIP']= $id_tip;
		$_SESSION['SITUA']= $id_situa ;
		$_SESSION['NF']= $id_nf;
		
		switch ($id_tip) 
			{
    			case "TECNOLOGIA":
					
       				echo " <iframe src=bens_tecno.php name=display width=1300 marginwidth=0 height=720 marginheight=0 frameborder=0class=style7id=display ></iframe>";
        		break;
    			case "MOVEIS":
        			echo " <iframe src=bens_moveis.php name=display width=1300 marginwidth=0 height=720 marginheight=0 frameborder=0class=style7id=display ></iframe>";
       			break;
    			case "ELETRONICOS":
        			echo " <iframe src=bens_eletron.php name=display width=1300 marginwidth=0 height=720 marginheight=0 frameborder=0class=style7id=display ></iframe>";
        		break;
				case "ELETRODOMESTICO":
        			echo " <iframe src=bens_eletrod.php name=display width=1300 marginwidth=0 height=720 marginheight=0 frameborder=0class=style7id=display ></iframe>";
        		break;
				case "OUTROS":
        			echo " <iframe src=bens_outros.php name=display width=1300 marginwidth=0 height=720 marginheight=0 frameborder=0class=style7id=display ></iframe>";
        		break;
		
		
	

			}
			}
			#echo " <iframe src=ramal.php name=display width=1300 marginwidth=0 height=720 marginheight=0 frameborder=0class=style7id=display ></iframe>";
  ?>
  
  <p>&nbsp;</p>
  <p><em>
    <label for="tip"></label>
    <label for="label2"></label>
    <label for="label2"></label>
  </em>
    <label for="label2"></label>
  </p>
  <p>
    <label for="label2"></label>
  </p>
</form>
</body>
</html>
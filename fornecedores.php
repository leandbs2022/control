<?php
#conexão do banco e declaração das classes
require("./conectar.php");
require("./class/class.forn.php");
#require("./class/class.cst.php");
#objeto classe
#$ICB = new cst;
$itens = new forn;
#Variaveis cadastro
$tipo = "";
$checar = false;
$cnpj= "";
$empr  = "";
$tel = "";
$contato  = "";
$cel = "";
$serv ="";
$ende  = "";
$bair="";
$cid= "";
$infor="";
$cep="";
$id_for = "";
$situa="";
$sit01="";
$sit02 = "";
$max = 0;
$min = 0;
$i = 0;
#variaveis de pesq.
$at= "";
$campo ="";
$busca = "";
$id = "0";
$descri = "";
#Variaveis Globais
session_start();
#pesquisa global
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
$_SESSION['numero']= "";
$_SESSION['nota']= "";
#usuarios acesso
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cadastro de dados</title>
<?php
if(empty($nome))
{
	header('Location: index.php'); 
}
if(isset($_POST['imagens'])) 
  		{
		$descri= $_POST['pes'];
		if(empty($descri)){
			}else{
			$_SESSION['nota'] = $descri;
			header('Location: arquivos.php',false);
			exit;
			}
		}
?>

</head>
<body >
<div class="container" >
	<form id="form1" name="form1" method="post" action="" >
<p align="left" action ="">
  <input name="voltar" type="submit" class="btn btn-secondary btn-sm" id="voltar" formaction="inicial.php" value="VOLTAR"  align="left"/>
  <?php 
$datedia = date('d/m/Y');
if($_SESSION['nivel'] <> 2)
{
	#tela de bloqueio caso o usuario não tenha acesso
	header('Location: BLOQUEIO.php'); 
}else{
	#caso livre acesso 
	$_POST['RadioGroup1']=0;
	$_POST['RadioGroup2']=0;
}
?>
 <?PHP
if(isset($_POST['LOC'])) 
  	{
	if(empty($_POST['pes'])){
		$_POST['pes'] = 0;
	}else{	
	 $id =$_POST['pes'];
		$_SESSION['nota'] = $id;
		}	
			$campo = "emp";
			if(($nivel == 2) )
				{
					$respo=$itens->lista($campo,$id);
					$query = mysqli_query("SELECT * FROM `forne_terc` WHERE  $campo='$id' ");
					if(mysql_num_rows($query))
						{
						while($array = mysql_fetch_row($query)) 
							{		
									$empr = $array[1];
									$cnpj = $array[2];
									$tel  = $array[3];
									$contato = $array[4];
									$cel  =$array[5];
									$serv = $array[6];
									$cep= $array[7];
									$ende = $array[8];
									$bair = $array[9];
									$cid = $array[10];
									$infor= $array[11];
									$situa= $array[12];
									$id_for = $array[0];
									
								if($situa === 1){
									$_POST['RadioGroup1']=1;
								}else{
									$_POST['RadioGroup2']=1;
								}
									
								}
								$tes= " Situação Atual: $situa";
								if($situa == "1"){
									echo "<b><font color='#298A08'> {$tes} Ativa</font></b>";
								}else{
									echo "<b><font color='#FF0000'> {$tes} Inativa </font></b>";
								}	
						}
				}
 
	}
	if(isset($_POST['pro'])) 
  	{
	
	if ($_SESSION['cont'] == $max){
			echo "Ultimo registro";
			$_SESSION['cont'] = 0;
		}else{
			$_SESSION['cont'] = $_SESSION['cont'] + 1 ;
			$campo = "id";
			$id =$_SESSION['cont']; 
			$respo=$itens->lista($campo,$id);
			$query = mysqli_query("SELECT * FROM `forne_terc` WHERE  $campo='$id' ");
					if(mysql_num_rows($query))
						{
						
							while($array = mysql_fetch_row($query)) 
								{		
									$empr = $array[1];
									$cnpj = $array[2];
									$tel  = $array[3];
									$contato = $array[4];
									$cel  =$array[5];
									$serv = $array[6];
									$cep= $array[7];
									$ende = $array[8];
									$bair = $array[9];
									$cid = $array[10];
									$infor= $array[11];
									$situa= $array[12];
								
									
								}
		
								$tes= " Situação Atual: ";
								if($situa == "1"){
									echo "<b><font color='#298A08'> <h6>{$tes} </h6>Ativa</font></b>";
								}else{
									echo "<b><font color='#FF0000'><h6> {$tes} </h6>Inativa </font></b>";
								}
								
						}
		}
		
	$MAXIMO = mysqli_query("SELECT MAX(id) FROM `forne_terc` where 1");
	$MINIMO = mysqli_query("SELECT MIN(id) FROM `forne_terc` where 1");
	$row = mysql_fetch_array($MAXIMO);
	$row2 =  mysql_fetch_array($MINIMO); 
	$max = $row[0];
	$min = $row2[0];
			
	}	
	if(isset($_POST['nex'])) 
  	{
		if ($_SESSION['cont'] == $min){
			echo "primeiro registro";
		}else{
			$_SESSION['cont'] = $_SESSION['cont'] - 1 ;
			$campo = "id";
			$id =$_SESSION['cont']; 
			$respo=$itens->lista($campo,$id);
			$query = mysqli_query("SELECT * FROM `forne_terc` WHERE  $campo='$id' ");
					if(mysql_num_rows($query))
						{
						
							while($array = mysql_fetch_row($query)) 
								{		
									$empr = $array[1];
									$cnpj = $array[2];
									$tel  = $array[3];
									$contato = $array[4];
									$cel  =$array[5];
									$serv = $array[6];
									$cep= $array[7];
									$ende = $array[8];
									$bair = $array[9];
									$cid = $array[10];
									$infor= $array[11];
									$situa= $array[12];
								
									
								}
		
								$tes= " Situação Atual: ";
								if($situa == "1"){
									echo "<b><font color='#298A08'> <h6>{$tes} </h6>Ativa</font></b>";
								}else{
									echo "<b><font color='#FF0000'><h6> {$tes} </h6>Inativa </font></b>";
								}
								
						}
		}
		
	$MAXIMO = mysqli_query("SELECT MAX(id) FROM `forne_terc` where 1");
	$MINIMO = mysqli_query("SELECT MIN(id) FROM `forne_terc` where 1");
	$row = mysql_fetch_array($MAXIMO);
	$row2 =  mysql_fetch_array($MINIMO); 
	$max = $row[0];
	$min = $row2[0];	
	
	}
		?>
<div class="" role="alert">
  <h1 align="left">CADASTRO DE FORNECEDORES</h1>
  <p align="left">&nbsp;</p>
  </div>
	  <table width="751" border="0" align="left">
	  <tr>
	    <td><H6>CNPJ</H6></td>              
	    <td><H6>Empresa</H6></td>
      </tr>
	  <tr>
	    <td>
	      <input class="cnpj" name='cnpj' id='cnpj' type="number"  onclick="function()" value="<?php echo $cnpj; ?>" size="20" maxlength="20" />
	          
	    <td>
	    <input name="empr" type="text" class="Leandro" id="empr" value="<?php echo $empr; ?>" size="40" maxlength="30"/>
		</td>
      </tr>
	  <tr>
      </tr>
	  <tbody>
	    <tr><H6>
	      <th><em><H6>Endereço</H6></em></th>
	      <th><H6>Cidade</H6></th>
	      <th><em><H6>Bairro</H6></em></th>
	      <th><em><H6>Cep</H6></em></th>
        </tr>
	    <tr>
	      <th width="200" scope="col"><em>
	        <input name="ende" type="text" id="ende" size="40" maxlength="40" value="<?php echo $ende; ?>"/>
	      </em></th>
	      <th width="200" scope="col"><em>
	        <input name="cid" type="text" id="cid" value="<?php echo $cid; ?>" size="15" maxlength="15" />
	      </em></th>
	      <th width="150" scope="col"><em>
	        <input name="bai" type="text" class="Leandro" id="bai" size="15" maxlength="15" value="<?php echo $bair; ?>"/>
	      </em></th>
	      <th width="183" scope="col"><em>
	        <input name="cep" type="text" class="Leandro" id="cep" size="15" maxlength="15" value="<?php echo $cep; ?>"/>
	      </em></th>
        </tr>
	    <tr>
	      <td><H6>Cel</H6></td>
	      <td ><em> <H6> Tel:</H6></em></td>
	      <td ><em> <H6> Tipo serv.</H6>
	      </em></td>
	      <td><em> <H6> Contato</H6></em></td>
        </tr>
	    <tr>
	      <td >
	        <input name="cel" type="text" class="Leandro" id="cel" size="15" maxlength="15" value="<?php echo $cel; ?>"/></td>
	      <td ><em>
	        <input name="tel" type="text" class="Leandro" id="tel" value="<?php echo $tel; ?>" size="15" maxlength="14"/>
	      </em></td>
	      <td ><em>
	        <input name="srv" type="text" id="srv" size="30" maxlength="30" value="<?php echo $serv; ?>" />
	      </em></td>
	      <td ><em><em>
	        <input name="cont" type="text" class="Leandro" id="cont" size="21" maxlength="15" value="<?php echo $contato; ?>"/>
	      </em></em></td>
        </tr>
      </tbody>
	  </table>
    <table width="1136" border="0">
	  <tbody>
	    <tr>
	      <th width="956" scope="col"><h6>
	        <input type="radio"  name="RadioGroup1" value="2" id="RadioGroup1_1" />
Ativa
<input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0" />
Inativa
	        </h6>
	        <h6><em>Informações Opicionais</em></h6>
            <p><em>
              <input name="OBSER" type="text" class="Leandro" id="OBSER" value="<?php echo $infor; ?>" size="130" align="right" />
          </em></p></th>
        </tr>
      </tbody>
	  </table>
	<em>
    </label>
    <label for="Salvar xls2"></label>
          <h6>Cod_Forn:</h6>
            <input name="txtid" type="text" id="txtid" value="<?php echo $id_for; ?>" size="4" maxlength="4" readonly="True" />
          <em>
          </em>
        <input type="submit" name="Salvar" id="Salvar" class="btn btn-secondary btn-sm" value="Novo/Alterar" />
        <input type="submit" name="impri" id="impri" class="btn btn-secondary btn-sm" value="Del reg." disabled="true"/>
        <input type="submit" name="pro" id="pro" class="btn btn-primary btn-sm" value="Próximo " />
        <input type="submit" name="nex" id="nex" class="btn btn-primary btn-sm" value="Anterior" />
        </em></p>
        <em>
        <h6>Empresa:</h6>
        <select name="pes" id="pes">
          <option></option>
          <?php
      $sql = mysqli_query($conn,"SELECT emp FROM forne_terc order by emp asc");
      
	  while($monta = mysqli_fetch_assoc($sql))
	  {
         echo '<option value="'.$monta['emp'].'">'.$monta['emp'].'</option>';
      }
	 ?>
       </select>
        <input type="submit" name="LOC" id="LOC" class="btn btn-success btn-sm" value="Localizar" />
        <input type="submit" name="imagens" id="imagens" onclick="Myclick()" class="btn btn-secondary btn-sm" value="Adicionar nota fiscal" <?php $_SESSION['nota'] = $descri; ?>/>
        <input type="submit" name="visual" id="visual" class="btn btn-success btn-sm" value="Visualizar todos" />
        </em>
	    <p><h1>Informações encontradas:</h1></p>
	    <?php 
	if(isset($_POST['Salvar'])) 
  	{			
			#$row = 0;
			#$id = 0;
			#$resultado = mysqli_query("SELECT MAX(id) FROM `forne_terc` where 1");
			#$row = mysql_fetch_array($resultado);
			#$id = $row[0] + 1;
		
		$sit01 = $_POST['RadioGroup1'];
		$sit02 = $_POST['RadioGroup2'];
		$cnpj= $_POST['cnpj'];
		$empr  = $_POST['empr'];
		$tel = $_POST['tel'];
		$contato  = $_POST['cont'];
		$cel = $_POST['cel'];
		$serv = $_POST['srv'];
		$cep  = $_POST['cep'];
		$bair= $_POST['bai'];
		$cid= $_POST['cid'];
		$ende= $_POST['ende'];
		if(empty($sit01)){$situa = $_POST['RadioGroup2'];}
		if(empty($sit02)){$situa = $_POST['RadioGroup1'];}
		if(empty($sit01) && empty($sit02)){$situa = 1;$_POST['RadioGroup2'] = 0;$_POST['RadioGroup1'] = 1;}
		$infor = $_POST['OBSER'];
		$id = $_POST['txtid'];	
		if($id == ""){ $id= 0;}
	
		if($nivel <> 2){
				echo "<h6>Voce nao tem permissao de salvar ou alterar dados!!!</h6>";
		}
		else
		{
				$resposta = $itens-> adicionar_forn($cnpj,$empr,$tel,$contato,$cel,$serv,$cep,$ende,$bair,$cid,$infor,$situa,$id);
		}
	}
	if(isset($_POST['impri'])) 
  			{
			if($nivel <> 2){
				echo "<h6>Voce nao tem permissao de excluir dados!!!</h6>";
		}
		else
		{
			$id = $_POST['txtid'];
			$resposta = $itens-> delete_forn($id);
		}
			}
       if(isset($_POST['visual'])) 
  			{
				$resposta = $itens-> lista($campo,$busca,$id);
				}
			 if(isset($_POST['Salve'])) 
  				{
				$descri= $_POST['pes'];
				switch ($descri) 
					{
    				case 0:
       					$campo = "id";
        			break;
					}
					$_SESSION['exec'] = $_POST['txtloc'];
					$_SESSION['pesq'] = $campo;
					#header('Location: relatorio.php');	
   		}
	?>
	</p>
	<script>
	var x = document.getElementById("form1")
	function Myclick() 
		{
        var mensagem = document.getElementById("pes").value
		if (mensagem === '') {
          alert ("Selecione o fornecedor no campo localizar empresa.")
        } 
			
      }
	</script>
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
	<script>
      $(document).ready(function(){
      $('#cpf').mask('00000-000')
      $('#cnpj').mask('00.000.000/0000-00')
      $('#telefone').mask('0000-0000')
    })
 </script> 
  </form>
</div>
</body>
</html>
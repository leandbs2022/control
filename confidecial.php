<?php
require("./class/class.cst.php");
require("./conectar.php");
$ICB = new cst;
$equip= "";
$area  = "";
$usuario = "";
$senha  = "";
$dica = "";
$infor ="";
$busca = "";
$sen = "";
session_start();
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$dep = $_SESSION['depart'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Segurança</title>
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body background="">
	<form id="form1" name="form1" method="post" action="" >
<div class="container">
  <p>
    <?php
$datedia = date('d/m/Y');

if($_SESSION['nivel'] <> 2 || $_SESSION['depart'] <> "8")
{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>" ; 
	header('Location: BLOQUEIO.php');
	echo "NIVEL SEM ACESSO: ", $dep;
}else{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ;
	echo "<P><h5>GERENTE DO SOFT</h5></P>";
}
?>
    <em>
    <?php
	
 if(isset($_POST['LOC'])) 
  	{
			if(($nivel == 2) )
				{
          if(empty($_POST['pes'])){
          
          }else{
					$busca=$_POST['pes'];
					$respo=$ICB->seg_pesq($busca);
					$query = mysqli_query($conn,"SELECT * FROM `infor_secret` WHERE  equip_prod='$busca' ") or die(mysqli_error($conn));
					if(mysqli_num_rows($query))
						{
							while($array = mysqli_fetch_row($query)) 
								{		
									$equip = $array[0];
									$area  = $array[1];
									$usuario = $array[2];
									$senha = base64_decode($array[3]);
									$dica =$array[4];
									$infor= $array[5];
									
								}
						}
          }
				}
     
	}
?>
    </em></p>
  <p>
    <input name="voltar" type="submit" class="btn btn-secondary btn-sm" id="voltar" formaction="inicial.php" value="VOLTAR"  align="left"/>
</p>
  <div class="" role="alert">
    <h1 align="left">INFORMAÇÕES DE SEGURANÇA</h1>
</div>
	  <h6>DESCRIÇÃO:
  <input name="equip" type="text" id="equip" value="<?php echo $equip; ?>" size="25" maxlength="25" tipo="number"/>
  AREA
    :
  <input name="area" type="text" id="area" value="<?php echo $area; ?>" size="25" maxlength="20"/>
 DICA:
  <input name="dica" type="text"  id="dica" size="20" value="<?php echo $dica; ?>"/>
    </h6>
    <table width="200" border="0">
        <tbody>
          <tr>
            <th scope="col"><h6>USUARIO</h6><input name="usuario" type="text"  id="usuario" size="15" maxlength="15" value="<?php echo $usuario; ?>"/></th>
            <th scope="col"><h6>SENHA</h6><input name="senha" type="text" id="label" size="15" maxlength="15" value="<?php echo $senha; ?>"/></th>
          </tr>
        </tbody>
    </table>
    <h6>INFORMAÇÃO</h6>
	  <h6>
  		<textarea type="text" id="infor" name="infor" rows="7" maxlength="500" cols="120" value="<?php echo $infor; ?>" ><?php echo $infor; ?></textarea>
    </h6>
<p><em>
  </em><em>
  <label for="label2"><h6>
  </label>
  </em>
  <p><em>
    <label for="NOME PC"></label>
    <label for="label2"></label>
</em><em>
<label for="label2"></label>
</em><em>
<input type="submit" name="Salvar" id="Salvar" class="btn btn-secondary btn-sm" value="Novo/Alterar" />
</em><em>
<input type="submit" name="del" id="del" class="btn btn-danger btn-sm" value="Delete senha" />
</em><em>
<input type="submit" name="LOC" id="LOC" class="btn btn-secondary btn-sm" value="Localizar" />
</em><em>
<select name="pes" id="pes">
  <?php
	$sql = mysqli_query($conn,"SELECT equip_prod FROM `infor_secret` WHERE 1 order by equip_prod");
	  while($monta = mysqli_fetch_assoc($sql))
	  {
        if(empty($monta)){
			
		}else{
		 	echo '<option value="'.$monta['equip_prod'].'">'.$monta['equip_prod'].'</option>';
		 }
      }
      ?>
</select>
</em></p>
  <p><em>
    <label for="DEP"></label>
  </em></p>
  <p><em>
    <label for="usuario"></label>
    <label for="label2"></label>  
    <label for="infor"></label>
    <?php
    if ( isset( $_POST[ 'Salvar' ] ) ) {

      $equip = $_POST[ 'equip' ];
      $area = $_POST[ 'area' ];
      $dica = $_POST[ 'dica' ];
      $usuario = $_POST[ 'usuario' ];
      $senha = $_POST[ 'senha' ];
      $infor = $_POST[ 'infor' ];
      $sen = base64_encode( $senha );
      $senha = $sen;
      if ( $nivel <> 2 ) {
        echo "Voce nao tem permissao de salvar ou alterar dados!!!";
      } else {
        $resposta = $ICB->seg( $equip, $area, $dica, $usuario, $senha, $infor );
      }
    }

    if ( isset( $_POST[ 'del' ] ) ) {
			echo("<label> <FONT COLOR=red><h5>Função desabiltada!!</h5></font></label>;");
    }
    ?>
    <label for="infor"><br />
      </label>
</em></p>
</div>
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
</body>
</html>
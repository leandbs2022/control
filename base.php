<?php
require( "./class/class.base.php" );
require( "./class/class.cst.php" );
require( "./conectar.php" );
$ICB = new base;
$login = new cst;
session_start();
$_SESSION[ 'exec' ] = "";
$_SESSION[ 'pesq' ] = "";
$busca = $_SESSION[ 'ID' ];
$nome = $_SESSION[ 'utilizador' ];
$_SESSION[ 'del_confirm' ] = 0;
$senha = "";
$nivel = $_SESSION[ 'nivel' ];
$loc = "";
$descr = "";
$tipo = "";
$descri = "";
$data = date( 'd/m/Y' );
$senha = 0;
$codigo = 0;
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

<title>informação TI</title>
</head>
<body background="">
	<div class="container">
<form id="form1" name="form1" method="post" action="" >
	
  
<h6>
    <p>
      <?php

      $datedia = date( 'd/m/Y' );
      if ( $_SESSION[ 'nivel' ] <> 2 ) {
        echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>";
        header( 'Location: BLOQUEIO.php' );
        echo "NIVEL SEM ACESSO: ";
      } else {
        echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>";
      }
      ?>
</h6>
  </p>
  <input name="voltar" type="submit" class="btn btn-secondary btn-sm" id="voltar" formaction="inicial.php" value="VOLTAR"  align="left"/>
  </p>
  <div class="" role="alert">
    <h1>INFORMAÇÕES</h1>
    <br />
  </div>
  <table width="206" height="35" border="0" align="left">
    <tbody>
      <tr>
        <th width="121" scope="row"><label for="label3">
          <h6>Data:
            </label>
          </h6>
          <h6><em>
            <input name="DT" type="text" class="Leandro" id="DT" value="<?php echo $data; ?>" size="15" maxlength="12"/>
            </em> <strong>
            <p></p>
            <label for="label3">Usuário:</label>
            </strong></h6>
          <h6><em>
            <input name="RESP" type="text" class="Leandro" id="RESP" size="15" maxlength="20" value="<?php echo $nome; ?>"/>
            </em></h6>
          <h6>Tipo:</h6>
          <h6><em>
            <select name="CMB" id="CMB">
              <?php
              $file = file( "cfg/base.txt" );
              for ( $i = 0; $i < count( $file ); $i++ ) {
                echo "\t<option value=\"$i\">" . trim( $file[ $i ] ) . "</option>\n";
              }
              ?>
            </select>
            </em></h6></th>
      </tr>
    </tbody>
  </table>

  <h6>Informações:</h6>
  <h6>
    <textarea type="text" id="OBSER" name="OBSER" rows="7" maxlength="500" cols="auto"></textarea>
  </h6>
  <p>&nbsp;</p>
<p><em>
    <input type="submit" name="Salvar" id="Salvar" class="btn btn-secondary btn-sm" value="Adicionar Conhecimento" />
    <input type="submit" name="del" id="del" onclick="" class="btn btn-danger btn-sm" value="Conhecimento Desnecessário"/>
  </em><em>Deletar o ID:
	  
  <input name="id" type="text" id="id" value="<?php echo $codigo; ?>" size="4" maxlength="12"/>
  </em><em>
  <?php
    if ( $_SESSION[ 'nivel' ] <> 2 ) {
      header( 'Location: BLOQUEIO.php' );
    } else {

    }
    if ( isset( $_POST[ 'Salvar' ] ) ) {
      $nome = $_SESSION[ 'utilizador' ];
      $data = $_POST[ 'DT' ];
      switch ( $_POST[ 'CMB' ] ) {
        case 0:
          $tipo = "TELEFONIA";
          break;
        case 1:
          $tipo = "REDE";
          break;
        case 2:
          $tipo = "COMPUTADOR";
          break;
        case 3:
          $tipo = "INTERNET";
          break;
        case 4:
          $tipo = "E-MAIL";
          break;
        case 5:
          $tipo = "IMPRESSORA";
          break;
        case 6:
          $tipo = "INTERFACE";
          break;
        case 7:
          $tipo = "FIREWALL";
          break;
        case 8:
          $tipo = "ANTT";
          break;
      }
      $descri = $_POST[ 'OBSER' ];
      $respo = $ICB->adicionar_base( $nome, $descri, $data, $tipo );

    }
  if ( isset( $_POST[ 'del' ] ) ) {
	  
	  $codigo = $_POST['id'];
      $respo = $ICB->delete_base($codigo);
  }
  ?>
	</form>
</p>
<h1 align="left">RESUMO</h1>

    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#adm" aria-expanded="false" aria-controls="collapseExample">
    Visualizar registros
  </button>
</p>
<div class="collapse" id="adm">
        <div class="card card-body">
          <?php
          	$loc= 0;
			$tipo="";
          	$respo = $ICB->visualize_base( $loc, $tipo )
          ?>
        </div>
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
	function login_del()
		{
		  if(confirm('Deseja realmente deleta?') == true)
			{
		
			}
		}
</script>
</body>
</html>
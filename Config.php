<?php
//Class necessarias
require( "./class/class.lembrei.php" );
require( "./conectar.php" );
//require_once( "dompdf/dompdf_config.inc.php" );
//Variaveis de conexão
$ICB = new lembrei;
//Variaveis
$dep = "";
$resp = "";
$descri = "";
//variaveis de secção
session_start();
$_SESSION[ 'exec' ] = "";
$_SESSION[ 'pesq' ] = "";
$nome = $_SESSION[ 'utilizador' ];
$nivel = $_SESSION[ 'nivel' ];
$_SESSION[ 'tipo_T' ] = "Re";
$tipo_t = $_SESSION[ 'nivel' ];
$data = date( 'd/m/Y' );
$busca = $_SESSION[ 'ID' ];
$userid = $_SESSION[ 'ID' ];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="mobile-web-app-capable", content="yes" />
<meta charset="utf-8" />
<meta name="version" content="3.0.289" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<title>Configurações</title>
<?php
$datedia=date('d-m-Y'); 
if ( $_SESSION[ 'nivel' ] == 1 ) {
  header( 'Location: BLOQUEIO.php' );
} else{
  echo "
  <div class=container>
  <h6><p>Login:{$nome} Data:{$datedia}</p></h6>
  </div>
  " ; 
}
?>
</head>
<body>
<div class="container">
	<form id="form1" name="form1" method="post" action="" >
    <p>
      <input name="voltar" type="submit" class="btn btn-secondary btn-sm" id="voltar" formaction="inicial.php" value="VOLTAR"  align="left"/>
    </p>
    <h1>CONFIGURAÇÕES</h1>
  <div class="content">
	  <table class="rTable">
	   <tr border="1">
		  <td width="340" height="301"  border="2"> 
			  <h6>BASE DE CONHECIMENTO</h6>
              <p>
                <input type="text" name="txtloc"  id="txtloc" size="45" class="" value=""/>
              </p>
              <p>
                <input type="submit" name="LOC" id="LOC" class="btn btn-secondary btn-sm" value="Adicionar um titulo para base de Conhecimento" />
              </p>
              <p></p>
              <p>
                <textarea type="text" name="txtloc2" id="txtloc2" rows="10" cols="40" value="" > <?php
        $file = file( "cfg/base.txt" );
        for ( $i = 0; $i < count( $file ); $i++ ) {
          echo $file[ $i ];
          $l = $i;
        }
        ?>
              </textarea>
              </p>
              <?php
      if ( isset( $_POST[ 'LOC' ] ) ) {
        $msg = $_POST[ 'txtloc' ];
        $msg = strtoupper( $msg );
        if ( empty( $msg ) ) {
          echo "<p><H3>Favor digite um titulo.</H3></p><br>";
        } else {
          if ( strpos( file_get_contents( "cfg/base.txt" ), $msg ) !== false ) {
            echo "<p><H3>Essa informação ja existe</H3></p><br>";
          } else {
            $myfile = fopen( "cfg/base.txt", "a" );
            fwrite( $myfile, $msg . "\n" );
            fclose( $myfile );
          }
        }
      }
      ?>
		   </td>
		  <td width="321"><h6>ESTOQUE</h6>
            <p>
              <input type="text" name="txtloc3"  id="txtloc3" size="45" class="" value=""/>
            </p>
            <p>
              <input type="submit" name="LOC2" id="LOC2" class="btn btn-secondary btn-sm" value="Adicionar característica de produtos " />
            </p>
            <p>
              <textarea type="text" name="txtloc4" id="txtloc4" rows="10" cols="40" value="" >  
              <?php
      $file = file( "cfg/estoque.txt" );
      for ( $i = 0; $i < count( $file ); $i++ ) {
        echo $file[ $i ];
      }
      ?> 
   </textarea>
            </p>
            <p>
              <?php
    if ( isset( $_POST[ 'LOC2' ] ) ) {
          $msg = $_POST[ 'txtloc3' ];
          $msg = strtoupper( $msg );
          if ( empty( $msg ) ) {
            echo "<p><H3>Favor digite o tipo  do produto.</H3></p><br>";
          } else {
            if ( strpos( file_get_contents( "cfg/estoque.txt" ), $msg ) !== false ) {
              echo "<p><H3>Essa informação ja existe</H3></p><br>";
            } else {
              $myfile = fopen( "cfg/estoque.txt", "a" );
              fwrite( $myfile, $msg . "\n" );
              fclose( $myfile );
            }
          }
        }
        ?>
          </p></td>
	      </tr>
	   </table>
   </div>
    <table class="rTable">
      <tr border="1">
        <td width="930" align="Left"><h2>LEMBRETES</h2>
          <H6>____________________________________________________________________</H6>
          <H6>Data:
            <input name="DT" type="date" class="" id="DT" value="<?php echo $data; ?>" size="15" maxlength="12"/>
            Usuário:
            <input name="RESP" type="text" class="" id="RESP" size="15" maxlength="20" value="<?php echo $nome; ?>"/>
            </p>
          </H6>
          <H6>Digite seu lembrete:</H6>
          <p>
            <textarea name="OBSER" cols="100" rows="2" class="" id="OBSER"><?php echo $descri; ?></textarea>
            <div>
            <input type="submit" name="Salvar" id="Salvar" class="btn btn-secondary btn-sm" value="Adicionar Lembrete" />
            <input type="submit" name="Vi" id="Vi" class="btn btn-secondary btn-sm" value="Visualizar todos" />
            </div>
          </p></td>
      </tr>
    </table>
    <p>&nbsp;      </p>
    <p>
      <?php
      if ( isset( $_POST[ 'Salvar' ] ) ) {
        $sql = mysqli_query( "SELECT * FROM login where Codigo = '$userid' " );
        if ( mysqli_num_rows( $sql ) ) {
          while ( $array = mysql_fetch_row( $sql ) ) {
            $dep = $array[ 3 ];
          }
        }

        $userid = $_SESSION[ 'ID' ];
        $data = $_POST[ 'DT' ];
        $descri = $_POST[ 'OBSER' ];
        if ( empty( $data ) ) {
          echo "Digite a data !!!! ";
        } else {
          $respo = $ICB->adicionar_lemb( $userid, $dep, $data, $descri );
        }
      }
      if ( isset( $_POST[ 'Vi' ] ) ) {
        $tipo = 0;
        $respo = $ICB->visualize( $busca, $data, $tipo );

      }
      ?>
    </p>
    <p>&nbsp;</p>
  </form>
</div>
</body>
</html>
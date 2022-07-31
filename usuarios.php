<?php
require( "./conectar.php" );
require( "./class/class.cst.php" );
$bd01 = new cst;
$resul = "";
$resul2 = "";
$depart = "";
$senha = "";
$dep = "";
$confir = "";
$nome = "";
$per = "";
$dep_nome = "";
$coddep = 0;
session_start();
$verificar = $_SESSION[ 'utilizador' ];
$nivel = $_SESSION[ 'nivel' ];
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
<title>Usuarios</title>
</head>
<body  onload="<?php if($nivel <> 2){echo "acesso negado";}?>" background="">
<form id="form1" name="form1" method="post" action="">
  <div class="container">
    <p align="ledt">
      <?php
      require( "./conectar.php" );
      if ( isset( $_POST[ 'loc' ] ) ) {
         if (empty($_POST['usuercmd'])){

         }else{
        $usuario = $_POST['usuercmd'];
        $query = mysqli_query( $conn,"SELECT * FROM login where Nome='$usuario'" ) or die(mysqli_error($conn));
        if ( mysqli_num_rows( $query ) ) {
          while ( $array = mysqli_fetch_row( $query ) ) {
            $resul = $array[ 1 ];
            $resul2 = $array[ 2 ];
            $depart = $array[ 4 ];
          }
        }
      }
      }
      ?>
      <?php require( "./conectar.php" );
      $datedia = date( 'd/m/Y' );

      if ( $_SESSION[ 'nivel' ] <> 2 || $_SESSION[ 'depart' ] <> "8" ) {
        #echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>" ;
        header( 'Location: BLOQUEIO.php' );
      } else {
        #echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ; 
        echo "<P><h5>GERENTE DO SOFT</h5></P>";
      }
      ?>
    <p align="ledt">
      <input name="voltar" type="submit" class="btn btn-secondary btn-sm" id="voltar" formaction="inicial.php" value="VOLTAR"  align="left"/>
    <div class="" role="alert">
      <h1 align="left">CADASTRO DE USUARIOS</h1>
      <p align="left">&nbsp;</p>
      <strong></strong></div>
    <table width="1109" border="0">
      <tbody>
        <tr>
          <th width="1099" height="34" align="left" scope="col"> <h6>USUARIO:
              <input type="text" name="nome" id="nome" tabindex="1" size="15" value="<?php echo $resul; ?>"/>
              NIVEL:
              <select name="niv" id="niv" tabindex="2" >
                <option ><?php echo $resul2;?></option>
                <option >1</option>
                <option >2</option>
              </select>
              DEPARTAMENTO: <!--1 = Comum 2 = Administrador -->
              <?php
              $sql = mysqli_query( $conn,"SELECT * FROM depart where cod_dep='$depart'" );
              if ( mysqli_num_rows( $sql ) ) {
                while ( $monta = mysqli_fetch_row( $query ) ) {
                  $dep_nome = $monta[ 'dep' ];
                }
              }
              ?>
              <select name="depart" id="depart">
                <option ><?php echo $dep_nome; ?></option>
                <?php
                $sql = mysqli_query( $conn,"SELECT dep FROM depart" );

                while ( $monta = mysqli_fetch_assoc( $sql ) ) {
                  echo '<option value="' . $monta[ 'dep' ] . '">' . $monta[ 'dep' ] . '</option>';
                }
                ?>
              </select>
              SENHA:</strong>
              <input name="senha" type="password" id="senha" tabindex="3" value="empty" size="10" maxlength="10"/>
              CONFIRME:
              <input name="conf" type="password" id="conf" tabindex="4" size="10" maxlength="10" />
              <br>
            </h6></th>
        </tr>
      </tbody>
    </table>
    <h6>
      <input type="submit" name="salve" id="salve" class="btn btn-secondary btn-sm" value="Salvar" tabindex="5" />
      <input type="submit" name="excluir" id="excluir" class="btn btn-danger btn-sm" value="Excluir usuário" tabindex="6" />
      <input type="submit" name="loc" id="loc" class="btn btn-success btn-sm" value="Localizar" tabindex="7" />
      <select name="usuercmd" id="" tabindex="6">
        <?php
        $sql = mysqli_query( $conn,"SELECT nome FROM login" );

        while ( $monta = mysqli_fetch_assoc( $sql ) ) {
          echo '<option value="' . $monta[ 'nome' ] . '">' . $monta[ 'nome' ] . '</option>';
        }
        ?>
      </select>
      <!--1 = Comum
2 = Administrador -->
      <input type="submit" name="departamento" id="departamento" class="btn btn-secondary btn-sm" value="Inserir depart."/>
      <input type="text" name="textdep" id="textdep" />
      <?php

      if ( $nivel <> 2 ) {
        echo "$_SESSION[utilizador] voce não tem permissao de criar ou alterar departamento!!!!";
      } else {
        if ( isset( $_POST[ 'departamento' ] ) ) {
          $dep = $_POST[ 'textdep' ];
          $resposta = $bd01->adicionar_dep( $dep );
        }
      }
      ?>
      </p>
    </h6>
    <p>&nbsp;</p>
    <div class="" role="alert">
      <h1 align="left">INFORMAÇÕES</h1>
      <strong></strong></div>
    <p>
      <?php
      if ( isset( $_POST[ 'excluir' ] ) ) {
        if ( isset( $_SESSION[ 'utilizador' ] ) ) {
          $verificar = "$_SESSION[utilizador]";
        }
        if ( isset( $_SESSION[ 'nivel' ] ) ) {
          $nivel = "$_SESSION[nivel]";
        }
        if ( $nivel <> 2 ) {
          echo "<h4>Voce nao tem permissao de excluir usuario!!!</h4>";
        } else {
          $usuario = $_POST[ 'nome' ];
          if ( empty( $usuario ) ) {
            echo "<h4>Não há usuário a ser excluído!</h4>";
          } else {

            if ( $verificar <> $usuario ) {
              $query = mysqli_query( $conn,"SELECT * FROM login where Nome='$usuario'" );
              if ( mysqli_num_rows( $query ) ) {
                if ( $usuario <> "Administrador" ) {
                  $query = mysqli_query( "DELETE FROM `login` WHERE nome='$usuario'" )or die( mysql_error() );
                  echo "<h4>O usuario $usuario foi excluido com sucesso!!!</h4>";
                } else {
                  echo "<h4>O Administrador do sistema nao pode ser excluido!!!!</h4>";
                }
              }
            } else {
              echo "<h4>Voce nao pode se excluir!!!!</h4>";
            }
          }
        }


      }
      if ( isset( $_POST[ 'salve' ] ) ) {
        if ( empty( $_POST[ 'nome' ] ) || empty( $_POST[ 'senha' ] ) || empty( $_POST[ 'niv' ] ) ) {
          echo "<h4>favor preenchar todos os campos !!!</h4>";
        } else {

          $senha = "";
          $nome = "";
          $nivel = "";
          $senha = $_POST[ 'senha' ];
          $confir = $_POST[ 'conf' ];
          $nome = $_POST[ 'nome' ];
          $per = $_POST[ 'niv' ];
          $dep = $_POST[ 'depart' ];
          $sql = mysqli_query( $conn,"SELECT cod_dep FROM depart where dep='$dep'" );
          while ( $monta = mysqli_fetch_assoc( $sql ) ) {
            $dep = $monta[ 'cod_dep' ];
          }
          $cript = base64_encode( $senha );
          $cript2 = base64_encode( $confir );
          if ( $cript <> $cript2 ) {
            echo "<h4>Senha nao confere favor digitar novamente!!</4>";
          } else {
            $senha = $cript;


            if ( isset( $_SESSION[ 'utilizador' ] ) ) {
              $usuario = "$_SESSION[utilizador]";
            }
            if ( isset( $_SESSION[ 'nivel' ] ) ) {
              $nivel = "$_SESSION[nivel]";
            }
            if ( $nivel <> 2 ) {
              echo "<4>$_SESSION[utilizador] voce não tem permissao de criar ou alterar ususario!!!!</4>";
            } else {
              $sql = mysqli_query( $conn,"SELECT Codigo FROM login ORDER BY Codigo DESC LIMIT 1 " );
              if ( mysqli_num_rows( $sql ) ) {
                while ( $array = mysqli_fetch_row( $sql ) ) {
                  $cod = $array[ 0 ];
                }
              }
              $resposta = $bd01->usuarios( $cod, $nome, $senha, $per, $dep );
            }
          }
        }
      }
      ?>
    </p>
    <p>
      <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#adm" aria-expanded="false" aria-controls="collapseExample"> Departamentos e Usuarios </button>
    </p>
    <div class="collapse" id="adm">
      <div class="card card-body">
        <div class="alert alert-success btn-sm" role="alert">
          <h6 align="left">Nivel: 1 = Usuário | 2 = Administrador | Grupo: GERENCIA SOFT - Acesso a senhas de seguranças e usuários.</h6>
        </div>
        <p> </p>
        <div class="btn-default btn-sm" role="alert">
          <h5 align="left">DEPARTAMENTOS E USUARIOS</h5>
        </div>
        <p>
          <?php
          $query = mysqli_query( $conn,"SELECT `Nome`,`Nivel`,`dep`FROM `login` WHERE 1" );
          $depart = "";
          $ext = "";
          if ( mysqli_num_rows( $query ) ) {
            $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
            $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
            $estilos[] = "text-align: center;font-size:14px; width: 200%;";
            echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
					<td style=\"$estilos[0]\">Usuario</td>
					<td style=\"$estilos[0]\">Nivel de acesso</td>
					<td style=\"$estilos[0]\">Dep</td>
					";
            while ( $array = mysqli_fetch_row( $query ) ) {

              echo "<tr>
							<td style=background-color:WHITE align=center>$array[0]</td>
							<td style=background-color:WHITE align=center>$array[1]</td>
							<td style=background-color:WHITE align=center>$array[2]</td>
							</tr>";
            }

          }
          ?>
          <?php
          $sql = mysqli_query( $conn,"SELECT * FROM `depart` WHERE 1" );
          if ( mysqli_num_rows( $sql ) ) {
            $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
            $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
            $estilos[] = "text-align: center;font-size:14px; width: 200%;";
            echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
					<td style=\"$estilos[0]\">Departamentos Cadastrados</td>
					<td style=\"$estilos[0]\">CodDep</td>
					";
            while ( $array = mysqli_fetch_row( $sql ) ) {
              echo "<tr>
							<td style=background-color:WHITE align=center>$array[0]</td>
							<td style=background-color:WHITE align=center>$array[1]</td>
							</tr>";
            }

          }
          ?>
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
        </p>
      </div>
    </div>
  </div>
</form>
</body>
</html>

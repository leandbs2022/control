<?php
//Class necessarias
require( "./conectar.php" );
require( "./class/class.cst.php" );
require( "./class/class.lembrei.php" );

//variaveis
$icb = new cst;
$lem = new lembrei;
$array = "";
$data = "";
$nome = "";
$senha = "";
$nivel = "";
$comemoracao = "";
$pararLoop = 0;
$fundo = "img\fundo.jpg";

//Limpando o login anterior
session_start();
session_unset();
session_destroy();

//Variaveis globais
session_start();
$_SESSION[ 'utilizador' ] = 0;
$_SESSION[ 'nivel' ] = 0;
$_SESSION[ 'tipo_T' ] = "";
$_SESSION[ 'cont' ] = "0";
$_SESSION[ 'IMPRESSAO' ] = "0";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="shortcut icon" href="img/icons/elite/ICO/My Network.ico" type="img/icons/elite/ICO">
<title>CONTROL-TI</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/icons/elite/ICO/My Network.ico" type="img/icons/elite/ICO">
<title img >Login</title>
</head>
<body >
<form id="form1" name="form1" method="post" action="" >
<div class="container">
<div class=" "><h2>CONTROLE DE ACESSO</h2></div>
  <section id="primaria">
      <p>Usuários:
        <select name="nome" id="nome" tabindex="1">
          <?php
          require( "./conectar.php" );
          $sql = mysqli_query( $conn,"SELECT nome FROM login" );
          while ( $monta = mysqli_fetch_assoc( $sql ) ) {
            echo '<option value="' . $monta[ 'nome' ] . '">' . $monta[ 'nome' ] . '</option>';
          }
          ?>
        </select>
        Senha:
        <input name="senha" type="password" id="senha"  tabindex="2" size="10">
        <input type="submit" name="login" id="login" value="Entrar"  tabindex="3">
        <br>
      </p>
      <p>
        <?php
        require( "./conectar.php" );
        if ( isset( $_POST[ 'login' ] ) ) {
          $senha = $_POST[ 'senha' ];
          $nome = $_POST[ 'nome' ];
          if ( empty( $senha ) ) {
            echo "Digite uma senha para entrar!";
          } else {
            $query = mysqli_query($conn, "SELECT * FROM `login` WHERE 1" );
            if ( mysqli_num_rows( $query ) ) {
              $resposta = $icb->log( $senha, $nome );
            } else {
              $nome = "Administrador";
              $senha = "123admin";
              $cript = base64_encode( $senha );
              $per = 2;
              $dep = 8;
              $query = mysqli_query( $conn,"INSERT INTO login (Nome,Nivel,dep,Senha) VALUES ('$nome', '$per','$dep','$cript')" );
              echo "Esse e seu primeiro acesso. O usuario administrador foi criando a e senha 123admin. Apos o acesso favor muda senha para sua seguranca em Cadastro de usuarios!";
              return $query;
            }
          }
        }
        ?>
      </p>
  </section>
</div>
</from>
	<footer>
	
	</footer>
</body>
</html>

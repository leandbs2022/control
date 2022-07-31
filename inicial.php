<?php
//conectar a classe
//require( "./conectar.php" );
require( "./class/class.relogio.php" );
//obj classe
$rel = new relogio;
//variveis de secção
session_start();
$nome = $_SESSION['utilizador'];
$niv = $_SESSION['nivel'];
$_SESSION[ 'LEMBRETE' ] = "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
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
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
  <div class="btn-group">
    <button class="btn btn-secondary">SERVIÇOS</button>
    <button class="btn btn-secondary dropdown-toggle-split" data-toggle="dropdown"> <span class="caret"></span> </button>
    <ul class="dropdown-menu">
      <li><a href="rede.php" target=""><span class="glyphicon glyphicon-globe"></span>Infraestrutura</a></li>
      <li><a href="impressoras.php"><span class="glyphicon glyphicon-print"></span>Impressoras</a></li>
      <li><a href="base.php" target=""><span class="glyphicon glyphicon-education"></span>Base de conhecimento</a></li>
      <li><a href="movimentacao.php"><span class="glyphicon glyphicon-pencil"></span>Movimentação</a></li>
      <li><a href="fornecedores.php" target=""><span class="glyphicon glyphicon-pencil"></span>Fornecedores</a></li>
      <li><a href="estoque.php"><span class="glyphicon glyphicon-pencil"></span>Estoque</a></li>
      <li><a href="confidecial.php"><span class="glyphicon glyphicon-lock"></span>Segurança</a></li>
      <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span>Usuários</a></li>
      <li><a href="calculo.php"><span class="glyphicon glyphicon-education"></span>Calculo de horário</a></li>
      <li><a href="Config.php"><span class="glyphicon glyphicon glyphicon-cog"></span>Configuraçoes</a></li>
      <li><a href="#" target=""><span class="glyphicon glyphicon-info-sign"></span>Dashbord</a></li>
      <li><a href="index.php"><span class="glyphicon glyphicon-lock"></span>Bloquear Tela</a></li>
    </ul>
  </div>
  <?php
  if ( empty( $nome ) ) {
    header( 'Location: index.php' );
  }
  if ( $niv = 2 ) {
    $niv = "Administrador";
  } else {
    $niv = "Usuário";
  }
  ?>
  <div>
    <p align="right">
    <h6 align="right">Seu login: <?PHP echo "{$nome} - Nível: {$niv}" ?></h6>
    </p>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4">
      <div class="panel panel-primary ">
        <div class="panel-heading">INFRAESTRUTURA</div>
        <figure class="foto-legenda">
          <div class="panel-body"><a href=""><img src="img/site/rede.jpg" class="img-responsive" style="width:100%" alt="Image"></a></div>
          <div>
            <figcaption>
              <h4>Recurso em desenvolvimento</h4>
            </figcaption>
          </div>
        </figure>
        <div class="panel-footer"></div>
      </div>
    </div>

    
    <div class="col-lg-4 col-md-4 col-sm-4">
      <div class="panel panel-warning">
        <div class="panel-heading">IMPRESSORAS</div>
        <figure class="foto-legenda">
          <div class="panel-body"><a href="impressoras.php"><img src="img/site/impressora.jpg" class="img-responsive" style="width:100%" alt="Image"></a></div>
          <div>
            <figcaption>
              <h4>Impressoras e Toners</h4>
            </figcaption>
          </div>
        </figure>
        <div class="panel-footer"></div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
      <div class="panel panel-success">
        <div class="panel-heading">INFORMAÇÃO</div>
        <figure class="foto-legenda">
          <div class="panel-body"><a href="base.php"><img src="img/site/infor.png" class="img-responsive" style="width:100%" alt="Image"></a></div>
          <div>
            <figcaption>
              <h4>Base de conhecimentos</h4>
            </figcaption>
          </div>
        </figure>
        <div class="panel-footer"></div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="container">
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel panel-warning">
      <div class="panel-heading">MOVIMENTAÇÃO</div>
      <figure class="foto-legenda">
        <div class="panel-body"><a href="movimentacao.php"><img src="img/site/logistica.jpg" class="img-responsive" style="width:100%" alt="Image"></a></div>
        </p>
        <p>
        <div>
          <figcaption>
            <h4>Controle de Movimento</h4>
          </figcaption>
        </div>
      </figure>
      <div class="panel-footer"></div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel panel-danger">
      <div class="panel-heading">SEGURANÇA</div>
      <figure class="foto-legenda">
        <div class="panel-body"><a href="confidecial.php"><img src="img/site/seguranca.png" class="img-responsive" style="width:100%" alt="Image"></a></div>
        <div>
          <figcaption>
            <h4>Senhas Roteadores,WIFI etc....</h4>
          </figcaption>
        </div>
      </figure>
      <div class="panel-footer"></div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4">
    <div class="panel  panel-primary">
      <div class="panel-heading">USUARIOS</div>
      <figure class="foto-legenda">
        <div class="panel-body"><a href="usuarios.php"><img src="img/site/Login.jpg" class="img-responsive" style="width:100%" alt="usuários"></a></div>
        <div>
          <figcaption>
            <h4>Cadastro de usuários</h4>
          </figcaption>
        </div>
      </figure>
      <div class="panel-footer"></div>
    </div>
  </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4">
  <div class="panel panel-warning">
    <div class="panel-heading">FORNECEDORES</div>
    <figure class="foto-legenda">
      <div class="panel-body"><a href="fornecedores.php"><img src="img/site/fornecedor.jpg" class="img-responsive" style="width:100%" alt="Image"></a></div>
      </p>
      <p>
      <div>
        <figcaption>
          <h4>Informações de fornecedores</h4>
        </figcaption>
      </div>
    </figure>
    <div class="panel-footer"></div>
  </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4">
  <div class="panel panel-warning">
    <div class="panel-heading">ESTOQUE</div>
    <figure class="foto-legenda">
      <div class="panel-body"><img src="img/site/ESTOQUE.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
      </p>
      <p>
      <div>
        <figcaption>
          <h4>Em desenvolvimento</h4>
        </figcaption>
      </div>
    </figure>
    <div class="panel-footer"></div>
  </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4">
  <div class="panel  panel-info">
    <div class="panel-heading">CONFIGURAÇÃO</div>
    <figure class="foto-legenda">
      <div class="panel-body"><a href="Config.php"><img src="img/site/configuração.jpg" class="img-responsive" style="width:100%" alt="Image"></a></div>
      <div>
        <figcaption>
          <h4>Em desenvolvimento</h4>
        </figcaption>
      </div>
    </figure>
    <div class="panel-footer"></div>
  </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4">
  <div class="panel  panel-success">
    <div class="panel-heading">
      <?php $dt = date('d/m/Y' ); echo "LEMBRETE DO DIA: ".$dt; ?>
    </div>
    <figure class="foto-legend">
    <div class="panel-body">
      <?php
      require( "./class/class.lembrei.php" );
      require( "./conectar.php" );
      $ICB = new lembrei;
      $data = date( 'Y-m-d' );
      $busca = $_SESSION[ 'ID' ];
      $resposta = $ICB->visualize001( $busca, $data );
      $fundo = $_SESSION[ 'LEMBRETE' ];
      if ( empty( $fundo ) ) {
        echo "<h6>Sem lembrete para hoje!</h6>";
        echo "<a href=Config.php><img src=img/site/lembrete.jpg class=img-responsive style=width:100% alt=Image></a>";
      }
      ?>
    </div>
  </div>
</div>
<footer class="container-fluid text-center">
  <div>
	<?php
    $class_ = $rel->relogio_time();
    ?>
    <p> Desenvolvedor: Leandro Barbosa de Souza Versão 3.0.0 </p>
  </div>
</footer>
</body>
</html>

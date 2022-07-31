<?php
//conectar classes
require("./class/class.catedral.php");
require("./class/class.tonner.php");
require("./class/class.cst.php");
require("./conectar.php");
//conectando as classes
$ICB = new cst;
$to = new catedral;
$toner = new tonner;
//variaveis impressoras
$ip  = "";
$marca = "";
$local = "";
$campo = "";
$busca = "";
//Variaveis de media toner    
$ton = "";
$model = "";
$quant = 0;
$unid = "";
$combo_ = "";
//variaveis de movimentação
$cod = "";
$setores = "";
$equipa = "";
$dt_ent = "";
$dt_sai = "";
$col = "";
$dest = "";
$resp_sai = "";
$tip = "";
$tipo_eq = "";
$desc = "";
$respo = "";
$localize = "0";
$entrada = "";
$saida = "";
$quanti = "";
//global 
session_start();
$_SESSION['Toner_livre'] = 0;
$_SESSION['exec'] = "";
$_SESSION['pesq'] = "";
#$_SESSION['utilizador'] = "ICB";
#$_SESSION['nivel'] =1;
$nome = $_SESSION['utilizador'];
$nivel = $_SESSION['nivel'];
$resp_sai = $nome;
$_SESSION['entrada'] = "";
$_SESSION['saida'] = "";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <span id='topo'></span>
</head>

<body class="container">
  <p>
    <?php
    $datedia = date('d/m/Y');
    if ($_SESSION['nivel'] <> 2) {
      echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data: <label> {$datedia}</label>";
      header('Location: BLOQUEIO.php');
      echo "NIVEL SEM ACESSO: ";
    } else {
      echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>";
    }
    ?>
  </p>
  <form id="form1" name="form1" method="POST">
  <h1>Entrega de Equipamento e Suprimentos</h1>
    <section>
  <div class="row">
      <div class="forma">
      <fieldset>
        <p><label>ID:</label> <input name="cod" type="text" id="cod" onfocus="focusFunction()" onblur="blurFunction()" value="<?php echo $cod; ?>" size="5" maxlength="5" readonly="readonly" /></p>
        <p><label>PROD/SUPRI:</label><input type="text" name="EQUIP" id="equipa" onfocus="focusFunction()" onblur="blurFunction()" maxlength="30" value="<?php echo $equipa; ?>" /></p>
        <p>ENTRADA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="ENT" id="ENT" onfocus="focusFunction()" onblur="blurFunction()" maxlength="30" value="<?php echo $dt_ent; ?>"/></p>
        <p>SAIDA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="SAI" id="SAI" onfocus="focusFunction()" onblur="blurFunction()" maxlength="30" value="<?php echo $dt_sai; ?>" /></p>
        <p>SETOR:<input type="text" name="setor" id="setor" onfocus="focusFunction()" onblur="blurFunction()" maxlength="30" value="<?php echo $setores; ?>" /></p>
        <p>ENTREGUE:<input type="text" name="rec" id="rec" onfocus="focusFunction()" onblur="blurFunction()" maxlength="30" value="<?php echo $col; ?>" /></p>
        <p>DESTINO:<input type="text" name="DEST2" id="obs" size="20" maxlength="255" onfocus="focusFunction()" onblur="blurFunction()" value="<?php echo $dest; ?>" /></p>
        <p>TIPO:<br><select name="set2" id="myInput" title="TONER" onFocus="" onBlur="" value="<?php echo $tip; ?>">
          <?php
          $file = file("cfg/estoque.txt");
          for ($i = 0; $i < count($file); $i++) {
            echo "\t<option value=\"$i\">" . trim($file[$i]) . "</option>\n";
          }
          ?>
        </select>
        <p>MODELO:<br><input name="MOL" type="text" id="myInput2" onClick="" value="<?php echo $tipo_eq; ?>" size="30" maxlength="30" /></p>
        <p>QUANTIDADE:<br><input name="quant" type="number" id="quant" value="<?php echo $quanti; ?>" size="4" maxlength="4" /></p>
        <p>RESPONSAVEL:<br><input name="RESP" type="text" id="RESP" onClick="" value="<?php echo $resp_sai; ?>" size="20" maxlength="20" Readonly /></p>
        <p>OBSERVAÇÃO:<br><textarea type="text" name="obs"  id="obs2"  cols="40" rows="5"> <?php echo $desc; ?> </textarea></p>
      </fieldset>
      </div></div><br><br>
    <div>
      <input name="adicionar" type="submit" id="adicionar" class="btn btn-secondary btn-sm" value="Adic.Alter" />
      <input type="submit" name="busca" id="busca" class="btn btn-success btn-sm" value="Localizar Codigo." />
      <input name="cod_b" type="text" id="cod_b" value="" size="5" maxlength="9" />
      <input type="submit" name="pesdata" id="pesdata" class="btn btn-success btn-sm" onclick="" value="Pesq. por data saída" /><br><br>
      <input name="ENT2" type="date" id="ENT2" size="12" maxlength="12" value="" />
      á
      <input name="SAI2" type="date" id="SAI2" size="12" maxlength="12" value="" />
      <input type="submit" name="impr" id="impr" class="btn btn-success btn-sm" onclick="" value="Relatório em excel" formaction="relatoriotodos.php" formtarget="_blank" />
    </div>
    <?php
    if (isset($_POST['busca'])) {
      $campo = "cod";
      $cod = $_POST['cod_b'];
      if (empty($cod)) {
        echo "<script> alert (`Campo codigo esta vazio!`)</script>";
      } else {
        $localize = "1";
        $query = mysqli_query($conn, "SELECT * FROM movi_c where cod='$cod'") or die(mysqli_error($conn));
        if (mysqli_num_rows($query)) {
          while ($array = mysqli_fetch_row($query)) {
            $cod = $array[0];
            $equipa = $array[1];
            $dt_ent = $array[2];
            $dt_sai = $array[3];
            $setores = $array[4];
            $col = $array[5];
            $dest = $array[6];
            $resp_sai = $array[7];
            $tip = $array[8];
            $tipo_eq = $array[9];
            $quanti = $array[10];
            $desc = $array[11];
          }
        } else {
          echo "<script> alert (`Não foi encontrado nenhum registro!`)</script>";
        }
      }
    }
    ?>
    <?php
    if (isset($_POST['impr'])) {
      $_SESSION['entrada'] = "ENT2";
      $_SESSION['saida'] = "SAI2";
    }

    if (isset($_POST['adicionar'])) {
      $quanti = $_POST['quant'];
      if (empty($_POST['quant']) or $_POST['quant'] = 0) {
        echo "O campo quantidade esta vazio ou contém zero.";
      } else {
        $equipa = $_POST['EQUIP'];
        $dt_sai = $_POST['SAI'];
        $dt_ent = $_POST['ENT'];
        $setores = $_POST['setor'];
        $col = $_POST['rec'];
        $resp_sai = $_POST['RESP'];
        $dest = $_POST['DEST2'];
        $tip = $_POST['set2'];
        $tipo_eq = $_POST['MOL'];
        $desc = $_POST['obs'];
        $cod = $_POST['cod'];

        if ($tip === "TONER") {
          require("./conectar.php");
          $query = mysqli_query($conn, "SELECT * FROM impr_tonner WHERE ton='$tipo_eq'");
          if (mysqli_num_rows($query)) {
            $pesq = $to->baixa_toner($quanti, $tipo_eq);
            if ($_SESSION['Toner_livre'] === 1) {
              $quant = $_SESSION['estoque'] - $quanti;
              $today = $dt_sai;
              $ton = $tipo_eq;
              $unid = $dest;
              $pesq = $to->adicionar_mov($cod, $equipa, $dt_sai, $dt_ent, $setores, $col, $dest, $resp_sai, $tip, $tipo_eq, $quanti, $desc);
              $RESP = $toner->adicionar_media($ton, $today, $unid, $quant);
            }
          } else {
            echo "<h6>O modelo não consta no banco de dados favor verificar se o modelo esta cadastrado!</h6>";
          }
        } else {
          $pesq = $to->adicionar_mov($cod, $equipa, $dt_sai, $dt_ent, $setores, $col, $dest, $resp_sai, $tip, $tipo_eq, $quanti, $desc);
        }
      }
    }

    if (isset($_POST['impr'])) {

      $_SESSION['entrada'] = $_POST['ENT2'];
      $_SESSION['saida'] = $_POST['SAI2'];
    }

    if (isset($_POST['pesdata'])) {
      $entrada = $_POST['ENT2'];
      $saida = $_POST['SAI2'];

      if (($nivel == 2)) {
        $respo = $to->data_pes($campo, $entrada, $saida);
      }
    }
    ?>
    </br>
    <p>
      <input type="submit" class="btn btn-secondary btn-sm float-right" id="voltar" formaction="inicial.php" value="VOLTAR" />
      <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#adm" aria-expanded="false" aria-controls="collapseExample">Visualizar registros</button>
    </p>
    <div class="collapse" id="adm">
      <div class="card card-body">
        <div class="alert alert-secondary btn-sm" role="alert">
          <h1>TODOS REGISTROS</h1>
        </div>
        <?php
        $localize = "0";
        $respo = $to->lista_mov($cod, $setores, $equipa, $col, $resp_sai, $tip, $desc, $dt_sai, $dt_ent, $tipo_eq, $localize);
        ?>
      </div>
    </div>
    
    <script>
      var idleTime = 0;
      $(document).ready(function() {
        //Increment the idle time counter every minute.
        if ($('iframe').length < 1) // caso não exista iframe vamos incrementar o contador (idleTime) de 1 em 1 minuto
          var idleInterval = setInterval(timerIncrement, 60000); // 1 minutos
        // resetamos o contador caso sejam detetados estes eventos
        $(this).mousemove(function(e) {
          idleTime = 0;
        });
        $(this).keypress(function(e) {
          idleTime = 0;
        });
        $(window).on('scroll', function(e) {
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
      var x = document.getElementById("form1")
      x.addEventListener("focus", myFocusFunction, true)
      x.addEventListener("blur", myBlurFunction, true)

      function myFocusFunction() {
        document.getElementById("myInput").style.backgroundColor = "#C0C0C0"
        document.getElementById("equipa").style.backgroundColor = "#FFFF00"
        document.getElementById("ENT").style.backgroundColor = "#FFFF00"
        document.getElementById("setor").style.backgroundColor = "#FFFF00"
        document.getElementById("quant").style.backgroundColor = "#FFFF00"
        document.getElementById("RESP").style.backgroundColor = "#C0C0C0"
        window.$tip = document.getElementById("myInput").value

      }

      function myBlurFunction() {
        document.getElementById("myInput").style.backgroundColor = ""
        document.getElementById("myInput2").style.backgroundColor = ""
        document.getElementById("equipa").style.backgroundColor = ""
        document.getElementById("ENT").style.backgroundColor = ""
        document.getElementById("setor").style.backgroundColor = ""
        document.getElementById("quant").style.backgroundColor = ""
        document.getElementById("RESP").style.backgroundColor = ""
      }

      function Myclick() {
        var mensagem = document.getElementById("myInput").value
        if (mensagem === 'TONER') {
          var modelo
          var quantidade
          modelo = prompt('Digite o modelo do toner!')
          document.getElementById("myInput2").value = modelo
          $combo_ = modelo
          quantidade = prompt('Digite a quantidade a ser retirada')
          document.getElementById("quant").value = quantidade
        } else {
          quantidade = prompt('Digite a quantidade a ser retirada')
          document.getElementById("quant").value = quantidade
          document.getElementById("myInput2").value = ""
        }
      }
    </script>
  </form>
</body>

</html>
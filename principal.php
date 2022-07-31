<?php
require("./conectar.php");
require("./class/class.cst.php");
require("./class/class.lembrei.php");

$icb = new cst;
$lem = new lembrei;
$array = "";
$data = "";
$nome= "";
$senha="";
$nivel="";
$pararLoop = 0;
$fundo="img\fundo.jpg";
session_start();
$_SESSION['tipo_T']="";
$_SESSION['cont'] = "0";
$_SESSION['IMPRESSAO'] = "0";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link href="css/styles1.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Catedral T</title>
</head>
<?php echo $_SESSION['info'];?> 
    
<body >
    <div class="container">
    <div class="row">
        <div class="col-3">
          <table width="90" border="0">
            <tbody>
              <tr>
                <th width="154" height="71" scope="row"><p align="center"><strong><a href="redes.php" target="display"><img src="img/site/Network5.png" alt="u" width="64" height="64" align="middle"  target="display"/></a></strong></th>
              </tr>
              <tr>
                <th height="60" scope="row"><p align="center"><a href="movimentacao.php" target="display"><img src="img/site/business_inventory_maintenance_product_box_boxes_2326.png" alt="lem" width="64" height="64" align="middle"></a></th>
              </tr>
              <tr>
                <th height="60" scope="row"><p align="center"><a href="base.php" target="display"><img src="img/site/Wordpad.png" alt="Bin" width="64" height="64" align="middle" target="display" title="Modulo nao disponivel!"></a></th>
              </tr>
              <tr>
                <th height="60" scope="row"><p align="center"><strong><a href="impressoras.php" target="display"><img src="img/site/Print_icon-icons.com_74701.png" id="impr" alt="imp" width="64" height="64"></a></strong></th>
              </tr>
              <tr>
                <th height="60" scope="row"><p><a href="lembrete.php" target="display"><img src="img/site/organizer_calendar_clock_pencil_10047.png" alt="lem" width="60" height="64" align="middle"></a></p></th>
              </tr>
              <tr>
                <th height="60" scope="row"><p><a href=confidecial.php target=display><img src="img/site/keys_security_private_lock_1739.png" alt="u" width="64" height="64" align="middle"  target="display"/></a></p></th>
              </tr>
              <tr>
                <th height="114" scope="row"><p><a href=usuarios.php target=display><img src="img/site/Padlock_User_Control_23100.png" alt="u" width="64" height="64" align="middle" target="display"/></a></p></th>
              </tr>
              <tr>
                <th height="114" scope="row"><p><a href="index.php"><img src="img/site/blue_shutdown_poweroff__12422 .png" alt="u" width="64" height="64" align="middle" target="display"/></a></a></p></th>
              </tr>
            </tbody>
          </table>
        </div>
    <div class="col-3">
          <p>teste</p>
        </div>
        <div class="col-3">
          <iframe src="ramal.php" name="display" width="1000" marginwidth="0" height="620" border="0" marginheight="" frameborder="0" class="style4" id="display" ></iframe>
        </div>
    </div>
</div>
<p align="left" class="style5">&nbsp;</p>
<p align="left" class="style5">&nbsp;</p>
<p align="left" class="style5"><span class="fontes"></span><span class="style7">
</span>
</body>
</html>

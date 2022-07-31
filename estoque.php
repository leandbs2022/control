<!-- PHP VARIAVEIS E CLASSES-->
<?php
require("./class/class.estoque.php");
require( "./conectar.php" );
$estoque = new estoque;
$novo = "";
$produto= "";
$marca= "";
$modelo= "";
$quant="";
$datae= "";
$tipo= "";
$infor= "";
$data=date('d,m,Y');
$loc=0;
$id=0;

if(isset($_POST['pesq2'])){
    $id = $_POST['id'];
    $resultado = mysqli_query("SELECT * FROM `equip` WHERE id='$id'");
    if ( mysqli_num_rows( $resultado) ) {
        while ( $array = mysql_fetch_row( $resultado ) ) {
            $produto=$array[1];
            $marca=$array[2];
            $modelo=$array[3] ;
            $quant=$array[4];
            $datae=$array[5];
            $tipo=$array[6];
            $infor=$array[7];
        }
    }
    //$loc=1;
   // $visualizar = $estoque->visualizar($loc,$id);
   
}
?>
<!doctype html>
<html lang="pt-br">
<head>
<title> Estoque </title>
<meta charset="uft-8">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- CSS - FOLHA DE ESTILO-->
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form action="" method="post" name="form1" id="form1">
<header class="container">
    <h1>Controle de estoque</h1>
</header>
<div class="container"> 
<!--<iframe class="responsive-iframe" src="base.php" name="iframe_a" height="300px" width="100%" ></iframe>-->
<div class="row">
<!-- DIVISÃO DE 2 COLUNAS-->
<div class="column">
        <div class="col-lg-4 col-md-4 col-sm-4">
        <input type="submit" name="pesq2" id="pesq2" class="btn btn-secondary btn-sm" value="Localizar por ID"/>
        <input type="text" name="id" id="id" size="25" value="" placeholder="ID">
            <p><h6>Produto</h6></p>
            <p><input type="text" name="produto" id="produto" size="25" value="<?php echo $produto; ?>" placeholder="Obrigatório"></p>
            <p><h6>Marca</h6></p>
            <p><input type="text" name="marca" id="marca" size="25" value="<?php echo $marca; ?>" placeholder="Obrigatório"></p>
            <p><h6>Modelo</h6></p>
            <p><input type="text" name="modelo" id="modelo" size="25" value="<?php echo $modelo; ?>" placeholder="Obrigatório" ></p>
            <p><h6>Quantidade</h6></p>
            <p><input type="number" name="quant" id="quant" size="4" value="<?php echo $quant; ?>" placeholder="Obrigatório"></p>
            <p><h6>Atualização</h6></p>
            <p><input type="date" name="datae" id="datae" value="<?php echo $datae; ?>" ></p>
            <p><h6><label>Tipo</label></h6>
                <select name="tipo" id="tipo">
                <option value="<?php echo $tipo; ?>"></option>
              <?php
              $file = file( "cfg/estoque.txt" );
              for ( $i = 0; $i < count( $file ); $i++ ) {
                echo "\t<option value=\"$i\">" . trim( $file[ $i ] ) . "</option>\n";
              }
              ?>
            </select></p>
            <p><h6>Informação</h6></p>
            <textarea type="text" id="infor" name="infor" rows="10" maxlength="500" cols="50" value="<?php echo $infor; ?>"></textarea>
        </div>
        <div class="container-fluid">
        <input type="submit" name="novo" id="novo" class="btn btn-secondary btn-sm" value="Adicionar"/>
        <input type="submit" name="pesq" id="pesq" class="btn btn-secondary btn-sm" value="Visual. reg."/>
        
        <button type="button" onclick="pagehome()" name="Voltar" id="Voltar" class="btn btn-secondary btn-sm" >Voltar</button>
        </div>
    </div>
    <div class="column">
    <!-- PHP -->
    <?php
    if(isset($_POST['pesq'])){
        $loc=0;
         $visualizar = $estoque->visualizar($loc,$id);
    }
      if(isset($_POST['novo'])){

                $produto= $_POST['produto'];
                $marca = $_POST['marca'];
                $modelo= $_POST['modelo'];
                $quant = $_POST['quant'];
                $datae= $_POST['datae'];
                $tipo = $_POST['tipo'];
                $infor= $_POST['infor'];
                $result = $estoque->adicionar($produto,$marca,$modelo,$quant,$datae,$tipo,$infor);
            }
        ?>
    </div>
    </div>
</div>
</form>
<!-- javascript-->
<script>
function pagehome()  
   {
     window.location.href = "inicial.php";
    }
</script>
</body>
</html>
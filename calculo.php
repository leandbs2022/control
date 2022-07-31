<?php
    require( "./conectar.php" );
    require( "./class/class.catedral.php" );
    $db_c = new catedral;
    //Variaveis php
    $dia =0;
    $horas =0;
    $minutos=0;
    $hminutos= 0;
    $count = 0;
    $time=0;
    $resul = 0;
    $datadia = date('d/m/Y');
    $saida=0;
    $di=0;
    $mi = 0;
    $cal = 0;
    $prefixo = 0;
    $hora_v=0;
    $Minutos_v=0;
    $linha="";
    $limite_M =0;
    $limite_u =0;
    $livre=0;
    $data_M = "";
    $data_u = "";
    $dados="";
    $dias_v="";
    $valide_v = 0;
    $sql="";
    session_start();
    $_SESSION['Horas']=0;
    $_SESSION['Minutos']= 0;
    $_SESSION['prefixo']= 0;
    $atual = date('d/m/Y');
    $query = mysqli_query("SELECT * from `motoristas` WHERE LIVRE=1 AND DATA_M <'$atual'") or die(mysql_error());
    if (mysqli_num_rows($query)) {
      while ($array = mysql_fetch_row($query)) {
      $query = mysqli_query($conn,"UPDATE motoristas set DATA_M='',LIVRE=0 WHERE LIVRE=1");
      }
      echo"atualização completa";
    }
    header('Content-Type: text/html; charset=utf-8');
    echo setlocale(LC_ALL, 'pt_BR', 'pt_BR. iso-8859-1', 'pt_BR. utf-8', 'portuguese');
    
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="mobile-web-app-capable", content="yes" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding:wght@400;700&display=swap" rel="stylesheet">
<title>Monitriip 2022</title>

<!--Bootstrap-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!--CSS-->
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<div class="container">
<p><?php echo "<h1>Saída no dia:{$datadia}</h1>"; ?></p>
<?php
if(isset($_POST['loc'])) 
{
    $prefixo= $_POST['linha'];
    $cal = $_POST['linha'];
    $_SESSION['prefixo'] = $prefixo;
    $resposta = $db_c->pesq_viagens($prefixo,$hora_v,$Minutos_v,$linha);
    $hora_v = $_SESSION['Horas'];
    $Minutos_v = $_SESSION['Minutos'];
}
?>
<h6>
<label>Horário de saída</label><br>
<label>Saída:</label>
<input type="text" name="sai" id="sai" size="2"  onfocus="focusFunction()" onblur="blurFunction()" maxlength="2" value="00">
<label>:</label>
<input type="text" name="minutos" id="minutos" onfocus="focusFunction()" onblur="blurFunction()" size="2" maxlength="2" value="00">
<label>Horas</label>
<input type="text" name="hora" id="hora" size="4" maxlength="5" value="<?php echo $hora_v;?>">
<label>Minutos</label>
<input type="text" name="hminutos" id="hminutos" onfocus="focusFunction()" onblur="blurFunction()" size="2" maxlength="2" value="<?php echo $Minutos_v;?>">
<label>Prefixo</label>
<input type="text" name="linha1" id="linha1" size="8" maxlength="11" value="<?php echo $cal ; ?>">
<label>Qt.V</label>
<input type="text" name="mot" id="mot" size="2" placeholder="" maxlength="2" value="0" onfocus="focusFunction()" onblur="blurFunction()">
<input type="submit" name="cal" id="cal" value="Calcular" class="btn btn-secondary btn-sm" >
<br>
<label>Linha</label>
<input type="text" name="linha" id="linha" size="11" maxlength="11" value="">
<input type="submit" name="loc" id="loc" value="Localizar" class="btn btn-secondary btn-sm">
<input type="submit" name="via" id="via" value="Visualizar Linhas" onclick="focusFunction()" class="btn btn-secondary btn-sm">
<select name="cmb" id="cmb">
<option value=1>Ida</option>    
<option value=2>Volta</option>    
</select>
<input type="submit" name="por" id="por" value="Porcentagem % " onclick="focusFunction()" class="btn btn-secondary btn-sm">
<br><p><h1>Informações</h1></p>
</h6>
<?php
if(isset($_POST['por'])) 
{
    $resposta = $db_c->porcento();
}

if(isset($_POST['via'])) 
{
    $dias_v = $_POST['cmb'];
    if($dias_v == 1){
        echo "Ida | ";
    }else{
        echo "Volta | ";
    }
    
    $resposta = $db_c->semana($dias_v);
   
}
    if(isset($_POST['cal'])) 
    {
    $limite_M = $_POST['mot'];
    $limite_u = $_POST['mot'];
    $prefixo= $_POST['linha1'];
    $resposta = $db_c->pesq_viagens($prefixo,$hora_v,$Minutos_v,$linha);
    $hora_v = $_SESSION['Horas'];
    $Minutos_v = $_SESSION['Minutos'];
        //variaveis
        //$hora = $dia * 24;
        $horas= $_POST['hora'];
        $minutos= $_POST['minutos'];
        $hminutos= $_POST['hminutos'];
        $saida=$_POST['sai'];
        $h = $_POST['sai'];
        $dias_c = $_POST['sai'];
        $t = $_POST['hora'];
        $dia = $horas / 24 ;
        $d = date('d');
        $d= $d + intval($dia);
        $m = date('m/Y');
        //Logica Repita quantidade de horas
        for ($i=0; $i < $horas; $i++){
        //conte um dia em 24hs
        $count = $count + 1;
        if($count == 24){ 
            $count = 0;
            $di = $di + 1;
        }else{    
            $saida = $saida + 1;
            $resul = $saida;
           if($saida >= 23){
               $saida = 0;    
            }        
        }
    }
//verificar horas 
    $dias_h = $count;
    if ($di > 0){
        if($dias_h < 24){
           $dias_c = $dias_c + $dias_h;
        }
    }
//verificando se as horas somadas são 24hs
   if($horas < 24){
    $conf = $h + $t;
   if($conf > 24){
    $d = date('d');
    $d= $d + 1;
    
    }
  }
   //calcule minutos de chegada
    if($minutos != "00" || $hminutos != "00"){
        $time = $minutos + $hminutos;
        //Logica Repita quantidade de minutos
        for($i=0; $i < $time; $i++){
            $mi = $mi + 1;
            if($mi >= 60){
            $mi = 0;
            }
    }
} 
//filtra numeros sem zero a esquerda
    switch($mi){
    case 0:
       $mi="00";
       break;
    case 1:
        $mi="01";
        break;
    case 2:
       $mi="02";
        break;
    case 3:
        $mi="03";
        break;
    case 4:
        $mi="04";
        break;
    case 5:
         $mi="05";
          break;
    case 6:
        $mi="06";
        break;
    case 7:
        $mi="07";
        break;
    case 8:
        $mi="08";
        break;
    case 9:
        $mi="09";
        break;
    }
  if($dias_c > 23){$d = $d + 1;}

  $TOTAL_HORAS_MANHA = 0;
    echo "<p><h6> Dados da chegada da viagem</h6></p>";
    echo "<p><h6> Data da chegada: {$d}/{$m} </h6></p>";
    echo "<p><h6> Hora da chegada: {$resul}:{$mi} - dias de viagem: {$di} | Horas:$count | Minutos: {$mi}</h6></p>"; 
    $data_M = date('d/m/Y');
    $data_u = date('d/m/Y');
    $confir = 0;
    $respost = $db_c->motorista($limite_M,$data_M,$confir);
    echo "<input type=submit name=cof id=cof value= Confirma_motorista>";
   
}
if(isset($_POST['cof'])) 
{
        $respost = $db_c->mupdate($limite_u,$data_u);
}
?>
<!--JAVASCRIPT-->
<script>

    var x = document.getElementById("form1")
    x.addEventListener("focus", myFocusFunction, true)
    x.addEventListener("blur", myBlurFunction, true)
    function numclick(){
        var valides = document.getElementById("hminutos").value
        if (valides > 59){
            alert('O numero digitado não e valido para minutos.Favor verificar!!')
            numero ="00"
            document.getElementById("hminutos").value = numero
        }
        var validev = document.getElementById("minutos").value
        if (validev > 59){
            alert('O numero digitado não e valido para minutos.Favor verificar!!')
            numero ="00"
            document.getElementById("minutos").value = numero
        }
        var valideh = document.getElementById("sai").value
        if (valideh > 23){
            alert('O numero digitado não e valido para hora.Favor verificar!!')
            numero ="00"
            document.getElementById("sai").value = numero
        }
    }
    function myFocusFunction() {
        var valides = document.getElementById("hminutos").value
        if (valides > 59){
            alert('O numero digitado não e valido para minutos.Favor verificar!!')
            numero ="00"
            document.getElementById("hminutos").value = numero
        }
        var validev = document.getElementById("minutos").value
        if (validev > 59){
            alert('O numero digitado não e valido para minutos.Favor verificar!!')
            numero ="00"
            document.getElementById("minutos").value = numero
        }
        var valideh = document.getElementById("sai").value
        if (valideh > 23){
            alert('O numero digitado não e valido para hora.Favor verificar!!')
            numero ="00"
            document.getElementById("sai").value = numero
            var tab = document.getElementById("td").value
        if (tab == 1){
            alert('O numero digitado não e valido para hora.Favor verificar!!')
          
    
        }
        }
      }	
    function myBlurFunction() {
        var valides = document.getElementById("hminutos").value
        if (valides > 59){
            alert('O numero digitado não e valido para minutos.Favor verificar!!')
            numero ="0"
            document.getElementById("hminutos").value = numero
        }
        var validev = document.getElementById("minutos").value
        if (validev > 59){
            alert('O numero digitado não e valido para minutos.Favor verificar!!')
            numero ="0"
            document.getElementById("minutos").value = numero
        }
        var valideh = document.getElementById("sai").value
        if (valideh > 23){
            alert('O numero digitado não e valido para hora.Favor verificar!!')
            numero ="0"
            document.getElementById("sai").value = numero
        }
        var tab = document.getElementById()
        if (tab == 1){
            alert('O numero digitado não e valido para hora.Favor verificar!!')
          
    
        }
      }
</script>
        </div>
    </form>
</body>

</html>
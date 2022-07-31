<?php
$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
class tonner {
  function visualizar_media() {
    require( "./conectar.php" );
    //variaveis
    $resultado_m = 0;
    $total = 0;
    $mes = date( "m" );
    $mes2 = date( "m" );
    $ano = date( "Y" );
    //data de busca
    if ( $mes == 01 and $mes2 == 01 ) {
      $mes = 13;
      $mes2 = 13;
      $ano = $ano - 1;
      $mes = $mes - 1;
      $mes2 = $mes2 - 1;
    }else{
      $mes = $mes - 1;
      $mes2 = $mes2 - 1;
    }
    $today = date( "$ano-$mes2-31" );
    $dat = date( "$ano-$mes-01" );
    $ton = "";
    $model = "";

    //ConexãO AO bd
    $query = mysqli_query( $conn,"SELECT ton FROM `impr_tonner` WHERE 1" );
    if ( mysqli_num_rows( $query ) ) {
      while ( $array = mysqli_fetch_row( $query ) ) {
        $ton = $array[ 0 ];
        $sql = mysqli_query( $conn,"SELECT * FROM `media_ton` WHERE modelo='$ton' and data_sai between '$dat' and '$today'" )or die( mysql_error() );
        if ( mysqli_num_rows( $sql ) ) {
          while ( $model = mysqli_fetch_row( $sql ) ) {
            $total = $total + $model[ 3 ];
            if ( $total != 0 ) {
              $resultado_m = 30 / $total;
              $resultado_m = number_format( $resultado_m, 0 );
            }
          }
          echo "<th width=856 scope=row ><div class=alert alert-primary btn-sm role=alert>
                                 <h2 align=left>Modelo: {$ton} <br> Usados: {$total} <br>Média para período de pedido é : {$resultado_m} dias</h2>
                                 </div></th>";
          $total = 0;
        }
      }

    } else {

    }
  }

  function adicionar_media( $ton, $today, $unid, $quant ) {
    require( "./conectar.php" );
    $ton = strtoupper( $ton );
    $unid = strtoupper( $unid );
    $query = mysqli_query( $conn,$conn,"INSERT INTO media_ton (modelo, data_sai, loc, quant) VALUES ('$ton', '$today', '$unid', '$quant')" )or die( mysql_error() );
  }

  function adicionar_tonner( $ton, $model, $quant ) {
    require( "./conectar.php" );
   
    $ton = strtoupper( $ton );
    $model = strtoupper( $model );
    if ( empty( $quant ) ) {
      $quant = 0;
    }
    if ( empty( $ton ) || empty( $model ) ) {
      echo "<h4>Favor verificar se todos os campos foram preenchido!!!</h4>";
      
    } else {
      
      $resultado = mysqli_query( $conn,"SELECT * FROM impr_tonner WHERE ton='$ton'" );
      if ( mysqli_num_rows( $resultado ) ) {
        $resultado = mysqli_query( $conn,$conn,"UPDATE `impr_tonner` SET `ton`='$ton',`model`='$model',`quant`='$quant' WHERE ton='$ton'" )or die( mysql_error() );
        echo "<h4>O cadastro foi alterado com sucesso!!!</h4>";
      } else {
        
        $resultado = mysqli_query($conn,$conn,"INSERT INTO `impr_tonner`(`ton`, `model`, `quant`, `loc_unid`) VALUES  ('$ton','$model','$quant','0')" )or die( mysql_error() );
        echo "<h4>Operacao foi concluida com sucesso!!!</h4>";
      }
    }
  }
  function delete_tonner( $ton )
  {
    require( "./conectar.php" );
    if ( empty( $ton ) ) {
      echo "<tr><td><h4>Não há toner selecionado para deletar!<h4></td></tr>";
    } else {

      $resultado = mysqli_query( $conn,"SELECT * FROM `impr_tonner` WHERE ton='$ton'" );
      if ( mysqli_num_rows( $resultado ) ) {

        $query = mysqli_query( $conn,"DELETE FROM `impr_tonner` WHERE ton='$ton'" );
        echo "Registro deletado!!!";

      } else {
        echo "<tr><td><h4>Error nao encontrado registro!!!<h4></td></tr>";

      }
    }
  }

  function lista_tonner( $busca ) {
    require( "./conectar.php" );
    if ( empty( $busca ) ) {
      $query = mysqli_query( $conn,"SELECT * FROM  `impr_tonner` WHERE 1 order by model asc" );
    } else {
      $query = mysqli_query( $conn,"SELECT * FROM `impr_tonner` WHERE  modelo='$busca' order by model asc" );
    }
    if ( mysqli_num_rows( $query ) ) {
      $total = 0;
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:13px";
      $estilos[] = "text-align: center;font-size:13px";
      $estilos[] = "text-align: center;font-size:13px width: 150%";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\"><b>MODELOS</b></td>
					<td style=\"$estilos[0]\"><b>TONER</b></td>
					<td style=\"$estilos[0]\"><b>QUANT</b></td>
					</tr>";

      while ( $array = mysqli_fetch_row( $query ) ) {
        if ( $array[ 2 ] == 0 ) {
          echo "<tr>
								<td style=background-color:white align=center>$array[0]</td>
								<td style=background-color:white align=center>$array[1]</td>
								<td style=background-color:red align=center>$array[2]</td>
							
								</tr>";
          $total = $total + 1;
        }
        if ( $array[ 2 ] >= 1 and $array[ 2 ] <= 2 ) {
          echo "<tr>
								<td style=background-color:white align=center>$array[0]</td>
								<td style=background-color:white align=center>$array[1]</td>
								<td style=background-color:yellow align=center>$array[2]</td>
							
								</tr>";
          $total = $total + 1;
        }
        if ( $array[ 2 ] >= 3 and $array[ 2 ] <= 5 ) {
          echo "<tr>
								<td style=background-color:white align=center>$array[0]</td>
								<td style=background-color:white align=center>$array[1]</td>
								<td style=background-color:6b8e23 align=center>$array[2]</td>
							
								</tr>";
          $total = $total + 1;
        }
        if ( $array[ 2 ] >= 6 ) {
          echo "<tr>
								<td style=background-color:white align=center>$array[0]</td>
								<td style=background-color:whitealign=center>$array[1]</td>
								<td style=background-color:00ffff align=center>$array[2]</td>
								
								</tr>";
          $total = $total + 1;
        }

      }
      echo "<tr><td style=\"$estilos[0]\"> <b>TONER CADASTRADOS: {$total}</b></td></tr>";
    } else {
      echo "<p><h4>Nenhum registro foi encontrado!!<h4></p>";
    }
    return $query;
  }

  function LEG() {
    require( "./conectar.php" );
    $estilos[] = "text-align: center; background-color: rgba(0, 0, 0, 0);font-size:13px";
    $estilos[] = "text-align: center;font-size:13px";
    $estilos[] = "text-align: center;font-size:13px width: 150%";
    echo "<table style=\"width: AUTO%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" ><tbody> <tr>
								<tr><td style=background-color:gray align=center>LEGENDAS:</td>
                                <tr><td style=background-color:RED align=center>URGENTE</td>
								<td style=background-color:YELLOW align=center>ATENÇÃO</td>
								<td style=background-color:6b8e23 align=center>BOM</td>
								<td style=background-color:00ffff align=center>OTIMO</td>
								</tr>";
  }
}
?>
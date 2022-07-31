<?php
$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
class base {
  function converte_data( $data ) {
    if ( preg_match( '/([0-9]+)-([0-9]+)-([0-9]+)/', $data ) ) {
      return preg_replace( '/([0-9]+)-([0-9]+)-([0-9]+)/', '$3/$2/$1', $data );
    } else {
      return preg_replace( '/([0-9]+)\/([0-9]+)\/([0-9]+)/', '$3-$2-$1', $data );
    }
  }

  function adicionar_base( $nome, $descri, $data, $tipo ) {
    require( "./conectar.php" );
    if ( empty( $descri ) ) {
      echo "<h4>Preenchar todos os campo!</h4>";
    } else {
      date_default_timezone_set( 'America/Sao_Paulo' );
      $data = date( 'd/m/Y' );
      $nome = strtoupper( $nome );
      $descri = strtoupper( $descri );
      $tipo = strtoupper( $tipo );
      $query = mysqli_query( $conn,$conn,"INSERT INTO `base`(`nome`, `descri`, `data`, `tipo`) VALUES ('$nome','$descri','$data','$tipo')" )or die( mysql_error() );
      echo "<h4>Operacao foi concluida com sucesso!!! $tipo</h4>";

      return $query;
    }
  }

  function delete_base( $codigo ) {
    require( "./conectar.php" );
    $resultado = mysqli_query($conn, "SELECT * FROM `base` WHERE `ID`=$codigo" );
    if ( mysqli_num_rows( $resultado ) ) {
      $query = mysqli_query( $conn,"DELETE FROM `base` WHERE `ID`= $codigo" );
      echo "<h4> Conhecimento deletado com sucesso!</h4>";
    } else {
      echo "<tr><td><h4>Não encontrado o registro:{$codigo}</h4></td></tr>";
    }

  }

  function visualize_base( $loc, $tipo ) {
    require( "./conectar.php" );
    if ( $loc == 1 ) {
      $query = mysqli_query($conn, "SELECT * FROM `base` WHERE tipo='$tipo' order by tipo asc" ) or die(mysqli_error($conn));
    } else {
      $query = mysqli_query($conn, "SELECT * FROM `base` WHERE 1 order by tipo desc" ) or die(mysqli_error($conn));
    }
    if ( mysqli_num_rows( $query ) ) {
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px; color:white;";
      $estilos[] = "text-align: center;font-size:14px";
      $estilos[] = "text-align: center;font-size:14px width: 200%";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\"><b>AUTOR</b></td>
					<td style=\"$estilos[0]\"><b>INFORMAÇÃO</b></td>
					<td style=\"$estilos[0]\"><b>DATA</b></td>
					<td style=\"$estilos[0]\"><b>TIPO</b></td>
					</tr>";

      while ( $array = mysqli_fetch_row( $query ) ) {
        echo "<tr>
					      <td style=background-color:white align=center> $array[0]</FONT></td>
								<td style=background-color:white align=center> $array[1]</FONT></td>
								<td style=background-color:white align=center>$array[2]</FONT></td>
								<td style=background-color:white align=center>$array[3]</FONT></td>
								</tr>";
      }
    } else {
      echo "<p><h4>Nenhum registro foi encontrado!!</h4></p>";
    }
    return $query;
  }
}
?>
<?php

$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
class lembrei {
 
  function converte_data( $data ) {
    if ( preg_match( '/([0-9]+)-([0-9]+)-([0-9]+)/', $data ) ) {
      return preg_replace( '/([0-9]+)-([0-9]+)-([0-9]+)/', '$3/$2/$1', $data );
    } else {
      return preg_replace( '/([0-9]+)\/([0-9]+)\/([0-9]+)/', '$3-$2-$1', $data );
    }
  }

  function adicionar_lemb( $userid, $dep, $data, $descri ) {
    require( "./conectar.php" );
    if ( $_SESSION[ 'utilizador' ] == "ICB" ) {
      echo "<label style=background-color:yellow align=center> Usuario ICB nao pode adicionar lembrete pois e um perfil padrao!!!</label>";
    } else {
      $descri = strtoupper( $descri );
      if ( empty( $descri ) ) {
        echo "favor verificar se todos os campos foi preenchido!!!";
      } else {
        $query = mysqli_query( $conn,$conn,"INSERT INTO `lemb`(`iduser`, `iddep`, `data`, `descr`) VALUES ('$userid','$dep','$data','$descri')" )or die( mysql_error() );
        echo "Operacao foi concluida com sucesso!!!";
        return $query;
      }
    }
  }

  function delete_tonner( $iduser, $data ) {
    require( "./conectar.php" );

    $resultado = mysqli_query($conn, "SELECT * FROM `lemb` WHERE iduser='$userid' and data='$data'" );
    if ( mysqli_num_rows( $resultado ) ) {
      $query = mysqli_query( $conn,"DELETE FROM `lemb` WHERE iduser='$userid' and data='$data'" );
      echo "Lembrete anteriores deletados!!!";
      return $query;
    } else {
      echo "<tr><td>Error nao encontrado registro!!!</td></tr>";
      return $query;
    }
  }

  function visualize001($busca,$data) {
    require( "./conectar.php" );
    $DADOS = "";
	  $numero = 0;
    $query = mysqli_query($conn, "SELECT * FROM `lemb` WHERE  iduser='$busca' and data ='$data'" );
    while ( $array = mysqli_fetch_row( $query ) ) {
		$DADOS = $array[3];
		$numero = $numero + 1;
		echo "<p align=left><h2>{$numero}-{$DADOS}</h2></p>";
    }  
	  $_SESSION['LEMBRETE'] = $DADOS;
  }

  function visualize( $busca, $data, $tipo ) {
    require( "./conectar.php" );
    $hoje = "";
    $cor = "";
    if ( $tipo == 0 ) {
      $query = mysqli_query($conn, "SELECT * FROM `lemb` WHERE  iduser='$busca'" );
      $hoje = "Todos os lembretes do usuario {$_SESSION['utilizador']}";
      $cor = "White";
    } else {
      $query = mysqli_query($conn, "SELECT * FROM `lemb` WHERE  iduser='$busca' and data ='$data'" );
      $hoje = "Lembre de hoje";
      $cor = "gray";
    }
    if ( mysqli_num_rows( $query ) ) {

      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
        $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
        $estilos[] = "text-align: center;font-size:14px; width: 200%;";

      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
					<td style=\"$estilos[0]\"><b>Data</b></td>
					<td style=\"$estilos[0]\"><b>$hoje</b></td>
					</tr>";

      while ( $array = mysqli_fetch_row( $query ) ) {
        echo "<tr>
								<td style=background-color:{$cor} align=center>$array[2]</td>
								<td style=background-color:{$cor} align=center>$array[3]</td>
								</tr>";
      }
    } else {
      echo "<p>Nenhum registro foi encontrado!!{$busca} {$data}</p>";
    }
    return $query;
  }
}
?>
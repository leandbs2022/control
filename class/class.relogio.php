<?php
$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
class relogio {
  function relogio_time() {
    date_default_timezone_set( 'America/Fortaleza' );
    $data = date( 'd-m-Y H:i' );
    $fuso = 0; //diferen�a entre voc� e o servidor onde est� sua p�gina.
    $fator = "-"; // coloque +, se seu hor�rio est� na frente do servidor, ou coloque - se seu.
    //hor�rio estiver atr�s do servidor.
    #pronto, daqui para baixo n�o tem mais o que configurar.
    $diasemana[ 0 ] = "Domingo";
    $diasemana[ 1 ] = "Segunda-feira";
    $diasemana[ 2 ] = "Ter�a-feira";
    $diasemana[ 3 ] = "Quarta-feira";
    $diasemana[ 4 ] = "Quinta-feira";
    $diasemana[ 5 ] = "Sexta-feira";
    $diasemana[ 6 ] = "S�bado";

    $mesnome[ 1 ] = "janeiro";
    $mesnome[ 2 ] = "fevereiro";
    $mesnome[ 3 ] = "mar�o";
    $mesnome[ 4 ] = "abril";
    $mesnome[ 5 ] = "maio";
    $mesnome[ 6 ] = "junho";
    $mesnome[ 7 ] = "julho";
    $mesnome[ 8 ] = "agosto";
    $mesnome[ 9 ] = "setembro";
    $mesnome[ 10 ] = "outubro";
    $mesnome[ 11 ] = "novembro";
    $mesnome[ 12 ] = "dezembro";

    $timeadjust = ( $fuso * 60 * 60 );

    If( $fator == "+" ) {
      $ano = date( "Y", time() + $timeadjust );
      $dia = date( "d", time() + $timeadjust );
      $diasem = date( "w", time() + $timeadjust );
      $hora = date( "G:i", time() + $timeadjust );
      $mes = date( "n", time() + $timeadjust );
    }

    If( $fator == "-" ) {
      $ano = date( "Y", time() - $timeadjust );
      $dia = date( "d", time() - $timeadjust );
      $diasem = date( "w", time() - $timeadjust );
      $hora = date( "G:i", time() - $timeadjust );
      $mes = date( "n", time() - $timeadjust );
    }
    #Fim do Script.
    #######################################################################################
    //Imprime a data.
    Echo "$diasemana[$diasem], $dia de $mesnome[$mes] de $ano $hora";
  }
}
?>
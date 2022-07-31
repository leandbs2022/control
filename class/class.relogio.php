<?php
$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
class relogio {
  function relogio_time() {
    date_default_timezone_set( 'America/Fortaleza' );
    $data = date( 'd-m-Y H:i' );
    $fuso = 0; //diferença entre você e o servidor onde está sua página.
    $fator = "-"; // coloque +, se seu horário está na frente do servidor, ou coloque - se seu.
    //horário estiver atrás do servidor.
    #pronto, daqui para baixo não tem mais o que configurar.
    $diasemana[ 0 ] = "Domingo";
    $diasemana[ 1 ] = "Segunda-feira";
    $diasemana[ 2 ] = "Terça-feira";
    $diasemana[ 3 ] = "Quarta-feira";
    $diasemana[ 4 ] = "Quinta-feira";
    $diasemana[ 5 ] = "Sexta-feira";
    $diasemana[ 6 ] = "Sábado";

    $mesnome[ 1 ] = "janeiro";
    $mesnome[ 2 ] = "fevereiro";
    $mesnome[ 3 ] = "março";
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
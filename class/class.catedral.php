<?php
$msg[] = "<p style=\"color:#FF0000;font-size:14px;font-family:Verdana;\" align=\"center\">";
$sql = "";
class catedral
{
  
  function semana($dias_v)
  {
    require( "./conectar.php" );
    //Variaveis
    $seg = "Monday";
    $ter = "Tuesday";
    $qua = "Wednesday";
    $qui = "Thursday";
    $sex = "Friday";
    $sab = "Saturday";
    $dom = "Sunday";
    $dados = "";
    $aponta  = date("l");
    //Comparações Inglês para português os dias
    switch ($aponta) {
      case $seg:
        $aponta = "Segunda";
        break;
      case $ter:
        $aponta = "Terça";
        break;
      case $qua:
        $aponta = "Quarta";
        break;
      case $qui:
        $aponta = "Quinta";
        break;
      case $sex:
        $aponta = "Sexta";
        break;
      case $sab:
        $aponta = "Sabado";
        break;
      case $dom:
        $aponta = "Domingo";
        break;
    }
    echo $aponta;
    //confirmar se encontrar ou não se e dia atual
    $query = mysqli_query($conn,"SELECT * FROM  `dias_v` WHERE 1 order by prefixo asc");
    if (mysqli_num_rows($query)) {
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
      $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
      $estilos[] = "text-align: center;font-size:14px; width: 200%;";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
        <td style=\"$estilos[0]\">Prefixo</td>
        <td style=\"$estilos[0]\">Linha</td>
         <td style=\"$estilos[0]\">Dias</td>
         </tr>";

      while ($array = mysqli_fetch_row($query)) {

        if (($dias_v == 1)) {
          $dados = $array[3];
        } elseif (($dias_v == 2)) {
          $dados = $array[4];
        }

        $pos = strpos($dados,$aponta);
        if ($pos == false) {
          echo "<h3>Nada Encontrado</h3>";
        } else {

          if ($dias_v == 1) {
            echo "<tr>
            <td style=background-color:white align=center>$array[0]</td>
            <td style=background-color:white align=center>$array[1]</td>
            <td style=background-color:white align=center>$array[3]</td>
             </tr>";
          } elseif ($dias_v == 2) {
            echo "<tr>
              <td style=background-color:white align=center>$array[0]</td>
              <td style=background-color:white align=center>$array[2]</td>
              <td style=background-color:white align=center>$array[3]</td>
               </tr>";
          }
        }
      }
    }
  }
  function mupdate($limite_u, $data_u)
  {
    require( "./conectar.php" );
    $query = mysqli_query($conn,"SELECT  DISTINCT * from `motoristas` WHERE LIVRE=0 limit $limite_u") or die(mysql_error());
    if (mysqli_num_rows($query)) {
      while ($array = mysqli_fetch_row($query)) {
        $cpf = $array[1];

        $sql = mysqli_query($conn,$conn,"UPDATE motoristas SET DATA_M='$data_u',LIVRE=1 WHERE CPF='$cpf'") or die(mysql_error());
      }
    }
  }
  function porcento()
  {
    require( "./conectar.php" );
    $valor = 0;
    $total = 0;
    $valort = 0;
    $query = mysqli_query($conn,"SELECT  DISTINCT * from `mensal2022` WHERE Mes='maio/2022'") or die(mysql_error());
    if (mysqli_num_rows($query)) {
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
      $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
      $estilos[] = "text-align: center;font-size:14px; width: 200%;";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
      <td style=\"$estilos[0]\">Prefixo</td>
      <td style=\"$estilos[0]\">Validas</td>
      <td style=\"$estilos[0]\">Viagens</td>
      <td style=\"$estilos[0]\">%</td>
      <td style=\"$estilos[0]\">Mês</td>
       </tr>";
      while ($array = mysqli_fetch_row($query)) {
        $valor = $array[1] / $array[3] * 100;
        $valor = intval($valor);
        $color = "";
        if ($valor >= 100) {
          $color = "green";
        }
        if ($valor < 100) {
          $color = "yellow";
        }
        if ($valor < 50) {
          $color = "red";
        }
        echo "<tr>
                 <td style=background-color:white align=center>$array[0]</td>
                 <td style=background-color:white align=center>$array[1]</td>
                 <td style=background-color:white align=center>$array[3]</td>
                 <td style=background-color:{$color} align=center>{$valor} %</td>
                 <td style=background-color:white align=center>$array[4]</td>
              </tr>";
        $total = $total + $array[1];
      }
      $valort = $total / 1630 * 100;
      $valort = intval($valort);
      if ($valort >= 75) {
        $color = "green";
      }
      if ($valort < 70) {
        $color = "yellow";
      }
      if ($valort < 45) {
        $color = "red";
      }
      echo "<tr> <td style=background-color:white align=center>Total validas: {$total}</td>
      <td style=background-color:white align=center>Total do mês: 1630</td>
      <td style=background-color:{$color} align=center>Geral: {$valort} %</td>
      </tr>";
    }



  }
  function motorista($limite_M, $data_M)
  {
    require( "./conectar.php" );
    $query = mysqli_query($conn,"SELECT  DISTINCT * from `motoristas` WHERE LIVRE=0 limit $limite_M") or die(mysql_error());
    if (mysqli_num_rows($query)) {
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
      $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
      $estilos[] = "text-align: center;font-size:14px; width: 200%;";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
      <td style=\"$estilos[0]\">Nome</td>
      <td style=\"$estilos[0]\">CPF</td>
       </tr>";
      echo "<p><h6> {$limite_M} - Motoristas disponiveis</h6></p>";
      while ($array = mysqli_fetch_row($query)) {
        echo "<tr>
                 <td style=background-color:white align=center>$array[0]</td>
                 <td style=background-color:white align=center>$array[1]</td>
              </tr>";
      }
    }
  }
  function pesq_viagens($prefixo, $linha)
  {
    require( "./conectar.php" );
    $query = mysqli_query($conn,"SELECT * FROM viagens WHERE prefixo='$prefixo'");
    if (mysqli_num_rows($query)) {
      while ($array = mysqli_fetch_row($query)) {
        $linha = $array[1];
        $_SESSION['Horas'] = $array[4];
        $_SESSION['Minutos'] = $array[5];
        $_SESSION['prefixo'] = $array[0];
      }
      echo "<p><h1> Cod: {$prefixo} Horas:{$_SESSION['Horas']} Min:{$_SESSION['Minutos']} Linha: {$linha}</h1></p>";
    }
  }
  function linhas($busca)
  {
    require( "./conectar.php" );
    $query = mysqli_query($conn,"SELECT * FROM  `viagens` WHERE prefixo='$busca' order by prefixo asc");
    if (mysqli_num_rows($query)) {
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
      $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
      $estilos[] = "text-align: center;font-size:14px; width: 200%;";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
        <td style=\"$estilos[0]\">Prefixo</td>
        <td style=\"$estilos[0]\">Linha</td>
         <td style=\"$estilos[0]\">Dias</td>
         </tr>";
      while ($array = mysqli_fetch_row($query)) {
        echo "<tr>
                                <td style=background-color:white align=center>$array[0]</td>
                                <td style=background-color:white align=center>$array[1]</td>
                                <td style=background-color:white align=center>$array[3]</td>
                                
                        </tr>";
      }
    }
  }
  //--------------------------------------------------------------------------------------------------------//
  function adicionar_mov($cod, $equipa, $dt_sai, $dt_ent, $setores, $col, $dest, $resp_sai, $tip, $tipo_eq, $quanti, $desc)
  {
    require( "./conectar.php" );
    $setores = strtoupper($setores);
    $equipa = strtoupper($equipa);
    $col = strtoupper($col);
    $dest = strtoupper($dest);
    $resp_sai = strtoupper($resp_sai);
    $tip = strtoupper($tip);
    $tipo_eq = strtoupper($tipo_eq);
    $desc = strtoupper($desc);
    $resultado = mysqli_query($conn,"SELECT * FROM `movi_c` WHERE cod = '$cod'");
    if (mysqli_num_rows($resultado)) {
      $query = mysqli_query($conn,$conn,"UPDATE `movi_c` SET quant='$quanti', tipo_eq='$tipo_eq',obs='$desc',colab='$col',dest='$dest',dt_sai='$dt_sai' WHERE cod='$cod'") or die(mysql_error());
      echo "<h4>O registro foi alterado com sucesso! (Apenas os campos Modelo,Quantidade, Entregue, e Obeservação podem ser alterados)</h4>";
      return $query;
    } else {
      if (empty($setores) || empty($equipa) || empty($quanti) || empty($dt_ent)) {
        echo $equipa, " - ", $dt_ent, " - ", $setores, " - ", $quanti;
        echo "<script>
					alert('Os campos amarelos são obrigatórios!')
			</script>";
      } else {
        $query = mysqli_query($conn,$conn,"INSERT INTO `movi_c`(equip,dt_ent,dt_sai,setor,colab,dest,resp_ent,tip,tipo_eq,quant,obs) VALUES ('$equipa','$dt_ent','$dt_sai','$setores','$col','$dest','$resp_sai','$tip','$tipo_eq','$quanti','$desc')") or die(mysql_error());
        echo "<h4>Operacao foi concluida com sucesso!!!</h4>";
        return $query;
      }
    }
  }
  function lista_mov($cod, $setores, $equipa, $col, $resp_sai, $tip, $desc, $dt_sai, $dt_ent, $tipo_eq, $localize)
  {
    if ($localize == 1) {
      require( "./conectar.php" );
      $query = mysqli_query($conn,"SELECT * FROM  movi_c WHERE cod='$cod' order by cod asc");
      if (mysqli_num_rows($query)) {
        $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
        $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
        $estilos[] = "text-align: center;font-size:14px; width: 200%;";
        echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
                                <td style=\"$estilos[0]\">COD</td>
                                <td style=\"$estilos[0]\">EQUIP</td>
                                <td style=\"$estilos[0]\">ENTRADA</td>
                                <td style=\"$estilos[0]\">SAIDA</td>
                                <td style=\"$estilos[0]\">SETOR</td>
                                <td style=\"$estilos[0]\">RECEBEDOR</td>
                                <td style=\"$estilos[0]\">DESTINO</td>
                                <td style=\"$estilos[0]\">ENTREGADOR</td>
                                <td style=\"$estilos[0]\">TIPO</td>
                                <td style=\"$estilos[0]\">MODELO</td>
								<td style=\"$estilos[0]\">QUANT</td>
                                <td style=\"$estilos[0]\">OBS</td>
                                </tr>";
        while ($array = mysqli_fetch_row($query)) {
          echo "<tr>
                                <td style=background-color:white align=center>$array[0]</td>
                                <td style=background-color:white align=center>$array[1]</td>
                                <td style=background-color:white align=center>$array[2]</td>
                                <td style=background-color:white align=center>$array[3]</td>
                                <td style=background-color:white align=center>$array[4]</td>
                                <td style=background-color:white align=center>$array[5]</td>
                                <td style=background-color:white align=center>$array[6]</td>
                                <td style=background-color:white align=center>$array[7]</td>
                                <td style=background-color:white align=center>$array[8]</td>
                                <td style=background-color:white align=center>$array[9]</td>
                                <td style=background-color:white align=center>$array[10]</td>
								<td style=background-color:white align=center>$array[11]</td>
                        </tr>";
        }
      }
    } else {
      //$today = date( "Y-m-d" );
      //$mes = date( "m" );
      //$mes2 = date( "m" );
      //$ano = date( "Y" );
      //$mes2 = $mes2 - 1;
      //if($mes2 < 10){
      //$mes2 = "0{$mes2}";
      //}
      //$today = date( "$ano-$mes-d");
      //$dat = date( "$ano-$mes2-01");
      //	echo "<h6>Pesquisa por data de entrada: {$dat} á {$today}</h6>";
      //$query = mysqli_query( $conn,"SELECT * FROM  `movi_c` WHERE dt_ent between '$dat'and '$today' order by dt_sai asc" )     
      require( "./conectar.php" );
      $query = mysqli_query($conn,"SELECT * FROM  `movi_c` WHERE 1 order by cod desc") or die(mysqli_error($conn));
      if (mysqli_num_rows($query)) {
        $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
        $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
        $estilos[] = "text-align: center;font-size:14px; width: 200%;";
        echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
        <td style=\"$estilos[0]\">COD</td>
        <td style=\"$estilos[0]\">EQUIPAMENTO</td>
         <td style=\"$estilos[0]\">ENTRADA</td>
         <td style=\"$estilos[0]\">SAIDA</td>
         <td style=\"$estilos[0]\">SETOR</td>
         <td style=\"$estilos[0]\">COLAB</td>
         <td style=\"$estilos[0]\">DESTINO</td>
         <td style=\"$estilos[0]\">ENTREGADOR</td>
         <td style=\"$estilos[0]\">TIPO</td>
         <td style=\"$estilos[0]\">MODELO</td>
				<td style=\"$estilos[0]\">QT.</td>
                                <td style=\"$estilos[0]\">OBSERVAÇÃO</td>
                                </tr>";
        while ($array = mysqli_fetch_row($query)) {
          echo "<tr>
                                <td style=background-color:white align=center>$array[0]</td>
                                <td style=background-color:white align=center>$array[1]</td>
                                <td style=background-color:white align=center>$array[2]</td>
                                <td style=background-color:white align=center>$array[3]</td>
                                <td style=background-color:white align=center>$array[4]</td>
                                <td style=background-color:white align=center>$array[5]</td>
                                <td style=background-color:white align=center>$array[6]</td>
                                <td style=background-color:white align=center>$array[7]</td>
                                <td style=background-color:white align=center>$array[8]</td>
                                <td style=background-color:white align=center>$array[9]</td>
								                <td style=background-color:white align=center>$array[10]</td>
                                <td style=background-color:white align=center>$array[11]</td>
                        </tr>";
        }
      }
    }
  }

  function data_pes($campo, $entrada, $saida)
  {
    //$campo = "dt_sai";
    if (empty($entrada) || empty($saida)) {
      echo "<h4>Favor preenchar todos os campos!</h4>";
    } else {
      require( "./conectar.php" );
      $query = mysqli_query($conn,"SELECT * FROM movi_c WHERE dt_sai >= '$entrada' and dt_sai <= '$saida' order by dt_sai asc");
      if (mysqli_num_rows($query)) {
        while ($array = mysqli_fetch_row($query)) {
          $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
          $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
          $estilos[] = "text-align: center;font-size:14px; width: 200%;";
          echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
             <td style=\"$estilos[0]\">REGISTROS ENCONTRADOS</td>";
          echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
             <td style=\"$estilos[0]\">CODIGO</td>
            <td style=\"$estilos[0]\">EQUIPAMENTO</td>
             <td style=\"$estilos[0]\">ENTRADA</td>
             <td style=\"$estilos[0]\">SAIDA</td>
             <td style=\"$estilos[0]\">SETOR</td>
             <td style=\"$estilos[0]\">RECEBEDOR</td>
            <td style=\"$estilos[0]\">DESTINO</td>
             <td style=\"$estilos[0]\">ENTREGADOR</td>
            <td style=\"$estilos[0]\">TIPO</td>
            <td style=\"$estilos[0]\">MODELO</td>
			<td style=\"$estilos[0]\">QUANT</td>
            <td style=\"$estilos[0]\">OBSERVAÇÃO</td>
           </tr>";
          while ($array = mysqli_fetch_row($query)) {
            echo "<tr>
             <td style=background-color:white align=center>$array[0]</td>
              <td style=background-color:white align=center>$array[1]</td>
             <td style=background-color:white align=center>$array[2]</td>
                                            <td style=background-color:white align=center>$array[3]</td>
                                            <td style=background-color:white align=center>$array[4]</td>
                                            <td style=background-color:white align=center>$array[5]</td>
                                            <td style=background-color:white align=center>$array[6]</td>
                                            <td style=background-color:white align=center>$array[7]</td>
                                            <td style=background-color:white align=center>$array[8]</td>
                                            <td style=background-color:white align=center>$array[9]</td>
											 <td style=background-color:white align=center>$array[10]</td>
                                            <td style=background-color:white align=center>$array[11]</td>
                                        </tr>";
          }
        }
      } else {
        echo "<h4>Nada encontrado</4>";
      }
    }
  }

  function baixa_toner($quanti, $tipo_eq)
  {
    require( "./conectar.php" );
    $_SESSION['Toner_livre'] = 0;
    $_SESSION['estoque'] = 0;
    $atual = "0";
    if (empty($quanti) || empty($tipo_eq)) {
      echo "Variaveis=", $quanti, $tipo_eq;
    } else {
      $query = mysqli_query($conn,"SELECT * FROM impr_tonner WHERE ton='$tipo_eq'");
      if (mysqli_num_rows($query)) {
        while ($array = mysqli_fetch_row($query)) {
          $atual = $array[2];
          $_SESSION['estoque'] = $array[2];
        }
        if ($atual < $quanti) {
          echo "Não há produto suficiente no estoque.";
          $_SESSION['Toner_livre'] = 0;
        } else {
          $atual = $atual - $quanti;
          $query = mysqli_query($conn,$conn,"UPDATE `impr_tonner` SET `quant`='$atual' WHERE ton='$tipo_eq'") or die(mysql_error());
          $_SESSION['Toner_livre'] = 1;
        }
      }
    }
  }
}

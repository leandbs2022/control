<?php
//Function
class estoque{
//criar registro e alterar
function adicionar($produto,$marca,$modelo,$quant,$datae,$tipo,$infor){
    if ( empty($produto) || empty($marca) || empty($modelo) || empty($quant) || empty($datae)) {
        echo "<h4>Preenchar todos os campo obrigatorios!</h4>";
      } else {
        $resultado = mysqli_query( "SELECT * FROM `equip` WHERE `produto`='$produto'");
        if ( mysqli_num_rows($resultado ) ) {
            $query = mysqli_query( $conn,"UPDATE `equip` SET `produto`=$produto,`marca`=$marca,`modelo`=$modelo,`quant`=$quant,`data_ent`=$datae,`tipo`= $tipo,`Infor_Adic`=$infor WHERE produto='$produto'");
            echo "Alterado com sucesso";
          } else {
            $query = mysqli_query( $conn,"INSERT INTO `equip`(`produto`,`marca`,`modelo`,`quant`,`data_ent`,`tipo`,`Infor_Adic`) VALUES ('$produto','$marca','$modelo','$quant','$datae','$tipo','$infor')" );
            echo "Criado registro com sucesso";
          }
      }

}
function visualizar($loc,$id){
    if($loc == 1){
        $resultado = mysqli_query("SELECT * FROM `equip` WHERE id='$id'");

    }else{
        $resultado = mysqli_query( "SELECT * FROM `equip` WHERE 1 ");
    }
    if ( mysqli_num_rows( $resultado) ) {
        $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px; color:white;";
        $estilos[] = "text-align: center;font-size:14px";
        $estilos[] = "text-align: center;font-size:14px width: 200%";
        echo "<table style=\"width: 130%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
                      <td style=\"$estilos[0]\"><b>  ID  </b></td>
                      <td style=\"$estilos[0]\"><b>  PRODUTO  </b></td>
                      <td style=\"$estilos[0]\"><b>  MARCA  </b></td>
                      <td style=\"$estilos[0]\"><b>  MODELO  </b></td>
                      <td style=\"$estilos[0]\"><b>  QUANT  </b></td>
                      <td style=\"$estilos[0]\"><b>  TIPO </b></td>
                      <td style=\"$estilos[0]\"><b>  INFORMAÇÃO </b></td>
                      </tr>";
  
        while ( $array = mysql_fetch_row( $resultado ) ) {
          echo "<tr>
                                  <td style=background-color:white align=center>$array[0]</FONT></td>
                                  <td style=background-color:white align=center>$array[1]</FONT></td>
                                  <td style=background-color:white align=center>$array[2]</FONT></td>
                                  <td style=background-color:white align=center>$array[3]</FONT></td>
                                  <td style=background-color:white align=center>$array[4]</FONT></td>
                                  <td style=background-color:white align=center>$array[6]</FONT></td>
                                  <td style=background-color:white align=center>$array[7]</FONT></td>
                                  </tr>";
        }
      }else{
          echo "Nenhum registro encontrado!";
      } 
    
}
function excluir(){
    
}
function imprimir(){   
}

}
?>
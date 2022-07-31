<?php
	$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
	class serv
	{
		#servi�o
		function adicionar_prev($descri,$data,$obs,$cnpj,$NF,$val) 
			{
				$descri= strtoupper($descri);
				$obs= strtoupper($obs);
				if(empty($valor)){$valor ="0";}
				if(empty($NF)){$NF ="0";}
			$query = mysqli_query($conn,"INSERT INTO prev(`descri`, `data`, `obs`, `cnpj`, `id_nf`,`valor`) VALUES ('$descri','$data','$obs','$cnpj','$NF','$val')") or die(mysql_error());
				echo "<b><font color=green> Operacao foi concluida com sucesso!!!</font></b>";
			}
			
			function lista_prev($cnpj)
			{	
				
				$query =mysqli_query("SELECT * FROM prev WHERE cnpj='$cnpj' order by data,id_nf asc");
				if(mysqli_num_rows($query))
					{
							$valor = 0;
							$estilos[] = "text-align: center; background-color: rgb(128, 128, 128);font-size:13px";
							$estilos[] = "text-align: center;font-size:13px";
							$estilos[] = "text-align: center;font-size:13px width: 200%";
							echo "<table style=\"width: 101%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
							<td style=\"$estilos[0]\">Descr.</td>
							<td style=\"$estilos[0]\">Data</td>
							<td style=\"$estilos[0]\">Serv.Prestado.</td>
							<td style=\"$estilos[0]\">CNPJ</td>
							<td style=\"$estilos[0]\">Nota</td>
							<td style=\"$estilos[0]\">valor</td>
							";
							while($array = mysql_fetch_row($query)) 
								{
									echo"<tr>								
									<td style=\"$estilos[1]\">$array[0]</td>
									<td style=\"$estilos[1]\">$array[1]</td>
									<td style=\"$estilos[1]\">$array[2]</td>
									<td style=\"$estilos[1]\">$array[3]</td>
									<td style=\"$estilos[1]\">$array[4]</td>
									<td style=\"$estilos[1]\">$array[5]</td>
									</tr>";
									#$valor = $array[5];
									
									$valor = floatval($array[5]) + intval($valor);
									
								}
								$total = number_format($valor,2,',','.');
						echo"<tr><td style=\"$estilos[0]\">Valor total das notas: $total </td></tr>";		
				}else{
				echo "<b><font color=red> Nenhum registro foi encontrado favor buscar outra empresa!!</font></b>";
				}	
			}
			
	}
	
?>
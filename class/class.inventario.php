	<?php
	$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
	class inventario
				#Empresa
					function adicionar_empresa($cnpj,$ins_est,$fant ,$end,$cid,$bair,$uf,$cep,$tel) 
					{
						date_default_timezone_set('America/Sao_Paulo');
						$data = date('d/m/Y');$nome= strtoupper($nome);
						$descri= strtoupper($descri);
						$tipo= strtoupper($tipo);
	$query = mysqli_query($conn,"INSERT INTO `base`(?`cnpj`, `estad`, `fant`, `end`, `cid`, `bai`, `cep`, `uf`, `tel`) VALUES ('$cnpj','$ins_est','$fant','$end','$cid','$bair','$uf','$cep','$tel')") or die(mysql_error());
						echo "Operacao foi concluida com sucesso!!!";
							return $query;
					}
	function alter_empresa($descri)
					{	
							
							$resultado = mysqli_query("SELECT * FROM `base` WHERE descri='$descri'");
							if(mysqli_num_rows($resultado))
								{
									$query = mysqli_query("DELETE FROM `base` WHERE descri='$descri'");
									echo "Conhecimento deletado !!!";
									
									}else{
									echo "<tr><td>Error nao encontrado registro!!!</td></tr>";
									}
					}
					
					#nota fiscal
					
					function adicionar_nf($nome,$descri,$data,$tipo) 
					{
						
						date_default_timezone_set('America/Sao_Paulo');
						$data = date('d/m/Y');$nome= strtoupper($nome);
						$descri= strtoupper($descri);
						$tipo= strtoupper($tipo);
						$query = mysqli_query($conn,"INSERT INTO `base`(`nome`, `descri`, `data`, `tipo`) VALUES ('$nome','$descri','$data','$tipo')") or die(mysql_error());
						echo "Operacao foi concluida com sucesso!!!";
						return $query;
					}
					
					function alter_nf($descri)
					{	
							$resultado = mysqli_query("SELECT * FROM `base` WHERE descri='$descri'");
							if(mysqli_num_rows($resultado))
								{
									$query = mysqli_query("DELETE FROM `base` WHERE descri='$descri'");
									echo "Conhecimento deletado !!!";
									
									}else{
									echo "<tr><td>Error nao encontrado registro!!!</td></tr>";
									}
					}
				#produto
				
				function adicionar_produto($nome,$descri,$data,$tipo) 
					{
						
						date_default_timezone_set('America/Sao_Paulo');
						$data = date('d/m/Y');$nome= strtoupper($nome);
						$descri= strtoupper($descri);
						$tipo= strtoupper($tipo);
						
			$query = mysqli_query($conn,"INSERT INTO `base`(`nome`, `descri`, `data`, `tipo`) VALUES ('$nome','$descri','$data','$tipo')") or die(mysql_error());
									echo "Operacao foi concluida com sucesso!!!";
									return $query;
					}
					function alter_prod($descri)
					{	
							
							$resultado = mysqli_query("SELECT * FROM `base` WHERE descri='$descri'");
							if(mysqli_num_rows($resultado))
								{
									$query = mysqli_query("DELETE FROM `base` WHERE descri='$descri'");
									echo "Conhecimento deletado !!!";
									
									}else{
									echo "<tr><td>Error nao encontrado registro!!!</td></tr>";
									}
					}
				
				#Localicar
				function visualize_empresa_nf_prod($loc,$id_busc)
				{
						
					switch ($loc) 
						{
    						case 1:
       							$query = mysqli_query("SELECT * FROM `empre` WHERE cnpj='$id_busc'");
        					break;
							case 2:
       							$query = mysqli_query("SELECT * FROM `nf` WHERE id_nf='$id_busc'");
        					break;
							case 3:
       							$query = mysqli_query("SELECT * FROM `caract` WHERE id_cod='$id_busc'");
        					break;
							case 4:
       							$query = mysqli_query("SELECT * FROM `invent ` WHERE id_cod='$id_busc'");
								if(mysqli_num_rows($query))
								{
						
						
								}
        					break;
							
							default
							
						}
						if(mysqli_num_rows($query))
						{
						if ($loc == 1 ){
						$estilos[] = "text-align: center; background-color: rgba(128, 128, 128);font-size:18px";
						$estilos[] = "text-align: center;font-size:18px";
						$estilos[] = "text-align: center;font-size:18px width: 200%";
						
						echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
						<td style=\"$estilos[0]\"><b>CNPJ</b></td>
						<td style=\"$estilos[0]\"><b>INSC_ESTADUAL</b></td>
						<td style=\"$estilos[0]\"><b>NOME</b></td>
						<td style=\"$estilos[0]\"><b>LOUGRADOURO</b></td>
						<td style=\"$estilos[0]\"><b>CIDADE</b></td>
						<td style=\"$estilos[0]\"><b>BAIRRO</b></td>
						<td style=\"$estilos[0]\"><b>UF</b></td>
						<td style=\"$estilos[0]\"><b>CEP</b></td>
						<td style=\"$estilos[0]\"><b>TEL</b></td>
						</tr>";	
						}
						if ($loc == 2 ){
						$estilos[] = "text-align: center; background-color: rgba(128, 128, 128);font-size:18px";
						$estilos[] = "text-align: center;font-size:18px";
						$estilos[] = "text-align: center;font-size:18px width: 200%";
						
						echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
						<td style=\"$estilos[0]\"><b>NF</b></td>
						<td style=\"$estilos[0]\"><b>DT COMPRAR</b></td>
						<td style=\"$estilos[0]\"><b>DT GARANTIA</b></td>
						<td style=\"$estilos[0]\"><b>DESC</b></td>
						<td style=\"$estilos[0]\"><b>LINK NFe</b></td>
						</tr>";	
						}
						
						if ($loc == 3 ){
						$estilos[] = "text-align: center; background-color: rgba(128, 128, 128);font-size:18px";
						$estilos[] = "text-align: center;font-size:18px";
						$estilos[] = "text-align: center;font-size:18px width: 200%";
						
						echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
						<td style=\"$estilos[0]\"><b>CODIGO</b></td>
						<td style=\"$estilos[0]\"><b>SITUA_ATUAL</b></td>
						<td style=\"$estilos[0]\"><b>TIPO</b></td>
						<td style=\"$estilos[0]\"><b>LOCAL</b></td>
						</tr>";	
						}
						while($array = mysql_fetch_row($query)) 
							{		
							switch ($loc) 
								{
										case 1:
										echo"<tr>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[0]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[1]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[2]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[3]</FONT></td>
											</tr>";
										break;	
										case 2:
										echo"<tr>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[0]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[1]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[2]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[3]</FONT></td>
											</tr>";
										break;
										case 3:
										echo"<tr>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[0]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[1]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[2]</FONT></td>
											<td style=\"$estilos[1]\"><FONT SIZE = 3>$array[3]</FONT></td>
											</tr>";
										break;
								}		
						}
					}
					else
					{
						echo "<p>Nenhum registro foi encontrado!!</p>";	
					}
					return $query;
					}
		}
?>
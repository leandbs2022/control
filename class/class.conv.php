	<?php
	$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
	class conv
		{
		function adicionar_conv($conv,$user,$pass,$contato,$guia,$infor,$link) 
			{
				$conv = strtoupper($conv);
				$guia = strtoupper($guia);
				$infor = strtoupper($infor);
				if(empty($conv))
						{
							echo "favor verificar se o campo convenio foi preenchido!!!";
						}
						else
						{
							$resultado = mysqli_query("SELECT * FROM acessos WHERE conv='$conv'");
							if(mysqli_num_rows($resultado))
								{	
							$query = mysqli_query($conn,"UPDATE `acessos` SET `conv`='$conv',`user`='$user',`pass`='$pass',`contato`='$contato',`guia`='$guia',`obser`='$infor',`link_email`='$link' WHERE conv='$conv'") or die(mysql_error());
								echo "O cadastro foi alterado com sucesso!!!";	
								return $query;
								}
								else
									{
									$query = mysqli_query($conn,"INSERT INTO `acessos`(`conv`, `user`, `pass`, `contato`, `guia`, `obser`, `link_email`) VALUES ('$conv','$user','$pass','$contato' , '$guia','$infor','$link')") or die(mysql_error());
									echo "Operacao foi concluida com sucesso!!!";
									return $query;
									}
						}
			}
		function lista_conv($busca)
			{
				if(empty($busca))
				{
					$query = mysqli_query("SELECT * FROM  `acessos` WHERE 1 order by conv asc");		
				}
				else
				{
					$query = mysqli_query("SELECT * FROM `acessos` WHERE  conv='$busca' order by conv asc");
				}
				if(mysqli_num_rows($query))
				{
					$total = 0;
					$estilos[] = "text-align: center; background-color: rgba(0, 0, 255, 0.15);font-size:16px";
					$estilos[] = "text-align: center;font-size:16px";
					$estilos[] = "text-align: center;font-size:16px width: 200%";
					echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\"><b>Convenio</b></td>
					<td style=\"$estilos[0]\"><b>Observ</b></td>
					<td style=\"$estilos[0]\"><b>Usuario</b></td>
					<td style=\"$estilos[0]\"><b>Senha</b></td>
					<td style=\"$estilos[0]\"><b>Contato</b></td>
					<td style=\"$estilos[0]\"><b>Guia</b></td>
					<td style=\"$estilos[0]\"><b>Links</b></td>
					</tr>";	
					
					while($array = mysql_fetch_row($query)) 
						{
							echo"<tr>
								<td style=background-color:white align=center>$array[0]</td>
								<td style=background-color:white align=center>$array[5]</td>
								<td style=background-color:white align=center>$array[1]</td>
								<td style=background-color:white align=center>$array[2]</td>
								<td style=background-color:white align=center>$array[3]</td>
								<td style=background-color:white align=center>$array[4]</td>
								<td style=background-color:white align=center><a href=$array[6]>$array[6]</a></td>
								</tr>";
								$total = $total + 1 ;
					}
				echo"<tr><td style=\"$estilos[0]\"> <b>Registros:{$total}</b></td></tr>";
				echo"<tr><td style=\"$estilos[0]\"> <b> <a href='#topo'>Volta ao topo</a></b></td></tr>";			
				}
				else
				{
					echo "<p>Nenhum registro foi encontrado!!</p>";	
				}
				return $query;
	}
	
	#tabela STATUS 
	function adicionar_status($status,$paciente,$conv,$matricula,$proc,$medic,$olho,$data,$guia,$infor) 
			{
				$paciente = strtoupper($paciente);
				$conv = strtoupper($conv);
				$guia = strtoupper($guia);
				$infor = strtoupper($infor);
				$medic = strtoupper($medic);
				$olho = strtoupper($olho);
				$proc = strtoupper($proc);
				
				if(empty($paciente))
						{
							echo "favor verificar se o campo paci�nte foi preenchido!!!";
						}
						else
						{
							$resultado = mysqli_query("SELECT * FROM status WHERE paciente='$paciente' and data='$data'");
							if(mysqli_num_rows($resultado))
								{	
							$query = mysqli_query($conn,"UPDATE `status` SET `STATUS` = '$status', `CONV`='$conv', `MATRICULA`='$matricula', `PROC`='$proc', `MEDICO`='$medic', `OLHO`='$olho', `GUIA`='$guia', `OBS`='$infor' WHERE paciente='$paciente' and data='$data'") or die(mysql_error());
								echo "O cadastro foi alterado com sucesso!!!";	
								return $query;
								}
								else
									{
									$query = mysqli_query($conn,"INSERT INTO `status`(`STATUS`, `PACIENTE`, `CONV`, `MATRICULA`, `PROC`, `MEDICO`, `OLHO`, `DATA`, `GUIA`, `OBS`) VALUES ('$status','$paciente','$conv','$matricula', '$proc','$medic','$olho','$data','$guia','$infor')") or die(mysql_error());
									echo "Operacao foi concluida com sucesso!!!";
									return $query;
									}
						}
			}
	
	
	function lista_status($busca,$campos)
			{
				if(empty($busca))
				{
					if($campos == "paciente"){$mensagem = "Favor digite o $campos a ser encontrado!!! ";}
					if($campos == "data"){$mensagem = "Favor digite a $campos a ser encontrada!!! ";}
					echo "<b><font color=red>$mensagem</font></b>";		
				}
				else
				{
					$query = mysqli_query("SELECT * FROM `status` WHERE $campos like '$busca%'");
				
				if(mysqli_num_rows($query))
				{
					$total = 0;
					$estilos[] = "text-align: center; background-color: rgba(0, 0, 255, 0.15);font-size:16px";
					$estilos[] = "text-align: center;font-size:16px";
					$estilos[] = "text-align: center;font-size:16px width: 200%";
					echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\"><b>Status</b></td>
					<td style=\"$estilos[0]\"><b>Paciente</b></td>
					<td style=\"$estilos[0]\"><b>Convenio</b></td>
					<td style=\"$estilos[0]\"><b>Matricula</b></td>
					<td style=\"$estilos[0]\"><b>Proc</b></td>
					<td style=\"$estilos[0]\"><b>Medico</b></td>
					<td style=\"$estilos[0]\"><b>Olho</b></td>
					<td style=\"$estilos[0]\"><b>Data</b></td>
					<td style=\"$estilos[0]\"><b>Guia</b></td>
					<td style=\"$estilos[0]\"><b>Observ</b></td>
					</tr>";	
					
					while($array = mysql_fetch_row($query)) 
						{
							if($array[0] =="AUTORIZADO")
							{
							echo"<tr>
								<td style=background-color:GREEN align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="NEGADO")
							{
							echo"<tr>
								<td style=background-color:RED align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="AGUARDANDO")
							{
							echo"<tr>
								<td style=background-color:yellow align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="PARCIAL")
							{
							echo"<tr>
								<td style=background-color:#33FFF9 align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="CANCELADO")
							{
							echo"<tr>
								<td style=background-color:ORANGE align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								</tr>";
								$total = $total + 1 ;
							}
					}
				echo"<tr><td style=\"$estilos[0]\"> <b>Registros:{$total}</b></td></tr>";	
				echo"<tr><td style=\"$estilos[0]\"> <b> <a href='#topo'>Volta ao topo</a></b></td></tr>";		
				}
				else
				{
				echo "<p>Nenhum registro foi encontrado!!</p>";	
				}
				return $query;
				
			}
			}
			
		function lista_data($datini,$datfim)
			{
				$query = mysqli_query("SELECT * FROM status WHERE data between '$datini' and '$datfim' order by data desc");
				if(mysqli_num_rows($query))
				{
					$total = 0;
					$estilos[] = "text-align: center; background-color: rgba(0, 0, 255, 0.15);font-size:16px";
					$estilos[] = "text-align: center;font-size:16px";
					$estilos[] = "text-align: center;font-size:16px width: 200%";
					echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\"><b>Status</b></td>
					<td style=\"$estilos[0]\"><b>Paciente</b></td>
					<td style=\"$estilos[0]\"><b>Convenio</b></td>
					<td style=\"$estilos[0]\"><b>Matricula</b></td>
					<td style=\"$estilos[0]\"><b>Proc</b></td>
					<td style=\"$estilos[0]\"><b>Medico</b></td>
					<td style=\"$estilos[0]\"><b>Olho</b></td>
					<td style=\"$estilos[0]\"><b>Data</b></td>
					<td style=\"$estilos[0]\"><b>Guia</b></td>
					<td style=\"$estilos[0]\"><b>Observ</b></td>
					<td style=\"$estilos[0]\"><b>Registro_ID</b></td>
					</tr>";	
					
					while($array = mysql_fetch_row($query)) 
						{
							if($array[0] =="AUTORIZADO")
							{
							echo"<tr>
								<td style=background-color:GREEN align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								<td style=background-color:WHITE align=center>$array[10]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="NEGADO")
							{
							echo"<tr>
								<td style=background-color:RED align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								<td style=background-color:WHITE align=center>$array[10]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="AGUARDANDO")
							{
							echo"<tr>
								<td style=background-color:yellow align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								<td style=background-color:WHITE align=center>$array[10]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="PARCIAL")
							{
							echo"<tr>
								<td style=background-color:#33FFF9 align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								<td style=background-color:WHITE align=center>$array[10]</td>
								</tr>";
								$total = $total + 1 ;
							}
							if($array[0] =="CANCELADO")
							{
							echo"<tr>
								<td style=background-color:ORANGE align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[2]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[7]</td>
								<td style=background-color:WHITE align=center>$array[8]</td>
								<td style=background-color:WHITE align=center>$array[9]</td>
								<td style=background-color:WHITE align=center>$array[10]</td>
								</tr>";
								$total = $total + 1 ;
							}
					}
				echo"<tr><td style=\"$estilos[0]\"> <b>Registros:{$total}</b></td></tr>";	
				echo"<tr><td style=\"$estilos[0]\"> <b> <a href='#topo'>Volta ao topo</a></b></td></tr>";		
				}
				else
				{
					echo "<p>Nenhum registro foi encontrado</p>";	
				}
				
			}
	}
	function convert()
	{
			
	
	}
			
			

				#$mensagem  = "";
				#if(empty($datini) ||empty($datfim))
				#{
					#if($datini == ""){$mensagem = "Favor digite a data inicio a ser encontrado!!! ";}
					#if($datfim == ""){$mensagem = "Favor digite a data final a ser encontrada!!! ";}
					#echo "<b><font color=red>$mensagem</font></b>";		
				#}
				#else
	
?>
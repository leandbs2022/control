	<?php
	$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
	require("./conectar.php");
	class cst
	{

		function dest()
		{
			$_SESSION['destino'] = "unidade";
			echo "variavel :" . $_SESSION['destino'];
		}
		function logC($senha, $nome)
		{
			require("./conectar.php");
			$query = mysqli_query($conn, "SELECT * FROM `login` WHERE Nome='$nome'");
			if (mysqli_num_rows($query)) {
				while ($array = mysqli_fetch_row($query)) {
					$cript = $array[4];
					$sen = base64_decode($cript);
				}
				if ($senha == $sen) {
					$_SESSION['del_confirm'] = 1;
				} else {

					$_SESSION['del_confirm'] = 0;
				}
			}
		}
		function log($senha, $nome)
		{
			require("./conectar.php");
			$_SESSION['utilizador'] = 0;
			$_SESSION['nivel'] = 0;
			$_SESSION['ID'] = 0;
			$_SESSION['info'] = "";
			$_SESSION['depart'] = 0;

			$query = mysqli_query($conn, "SELECT * FROM `login` WHERE Nome='$nome'");
			if (mysqli_num_rows($query)) {
				while ($array = mysqli_fetch_row($query)) {
					$cript = $array[4];
					$sen = base64_decode($cript);

					if ($senha == $sen) {
						date_default_timezone_set('America/Sao_Paulo');
						$data = date('d/m/Y H:i');
						$_SESSION['nivel'] = $array[2];
						if ($_SESSION['nivel'] <> 2) {
							$padrao = "Comum";
						} else {
							$padrao = "Administrador";
						}
						$mensa = "Login: $array[1] || $data ||  $padrao";
						$_SESSION['info'] = $mensa;
						$_SESSION['utilizador'] = $array[1];
						$_SESSION['ID'] = $array[0];
						$_SESSION['depart'] = $array[3];
						#$busca =$_SESSION['ID'];
						#$data = date('d/m/Y'); 
						header('Location: inicial.php');
					} else {

						echo "<h4>Acesso negado tente novamente senha incorreta!!!</h4>";
						$_SESSION['utilizador'] = 0;
						$_SESSION['nivel'] = 0;
						$_SESSION['depart'] = 0;
					}
				}
				return $query;
			} else {

				echo "<h4>Acesso negado tente novamente nome incorreto!!!</h4>";
				$_SESSION['utilizador'] = 0;
				$_SESSION['nivel'] = 0;
			}
		}

		function usuarios($cod, $nome, $senha, $per, $dep)
		{
			require("./conectar.php");
			$query = mysqli_query($conn, "SELECT * FROM `login` WHERE Nome='$nome'");
			if (mysqli_num_rows($query)) {
				$query = mysqli_query($conn, $conn,"UPDATE `login` SET `Nome`='$nome',`Senha`='$senha',`Nivel`='$per',`dep`='$dep' WHERE nome='$nome'") or die(mysql_error());
				echo "Esse usuario ja existe seus dados so foram atualizados!!!";
				return $query;
			} else {
				$cod = $cod + 1;
				$query = mysqli_query($conn, $conn,"INSERT INTO login (Codigo, Nome, Senha, Nivel,dep) VALUES ('$cod', '$nome', '$senha', '$per','$dep')") or die(mysql_error());
				echo "Usuario criado com sucesso!!!";
				return $query;
			}
		}

		function seg($equip, $area, $dica, $usuario, $senha, $infor)
		{
			require("./conectar.php");
			$equip = strtoupper($equip);
			$area = strtoupper($area);
			$dica = strtoupper($dica);
			$usuario = strtoupper($usuario);
			if (empty($equip)) {
				echo "<H4>Favor preencher o campo descr. para criar um registro!!!</H4>";
			} else {
				
				$query = mysqli_query($conn,"SELECT * FROM `infor_secret` WHERE equip_prod='$equip'") or die(mysql_error($conn));
				if (mysqli_num_rows($query)) {
					$query = mysqli_query($conn, $conn,"UPDATE `infor_secret` SET `area`='$area',`dica`='$dica',`usuario`='$usuario',`senha`='$senha' ,`infor_`='$infor' WHERE equip_prod='$equip'") or die (mysql_error($conn));
					echo "<H4>Essas informações ja existe e seus dados foram atualizados!!!</H4>";
					return $query;
				} else {
					$query = mysqli_query($conn,$conn,"INSERT INTO `infor_secret`(`equip_prod`, `area`, `usuario`, `senha`, `dica`, `infor_imp`) VALUES ('$equip', '$area', '$usuario','$senha' ,'$dica','$infor')") or die (mysql_error($conn));
					echo "<H4>Dados inseridos com sucesso!!!</H4>";
					return $query;
				}
			}
		}

		function adicionar($cnpj, $ip, $pc, $dep, $resp, $team, $ramal, $carg, $loc, $desc)
		{
			require("./conectar.php");
			$cnpj = strtoupper($cnpj);
			$ip = strtoupper($ip);
			$pc = strtoupper($pc);
			$dep = strtoupper($dep);
			$resp = strtoupper($resp);
			$team = strtoupper($team);
			$ramal = strtoupper($ramal);
			$carg = strtoupper($carg);
			$loc = strtoupper($loc);
			$desc = strtoupper($desc);

			date_default_timezone_set('America/Sao_Paulo');
			$data = date('Y-m-d H:i');

			if (empty($cnpj) || empty($ip) || empty($pc) || empty($dep) || empty($resp) || empty($team) || empty($ramal) || empty($carg) || empty($loc) || empty($desc)) {
				echo "favor verificar se todos os campos foram preenchidos!!!";
			} else {
				$resultado = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE ip='$ip'");
				if (mysqli_num_rows($resultado)) {


					$query = mysqli_query($conn, $conn,"UPDATE `red_tel` SET 					`cnpj`='$cnpj',`ip`='$ip',`host`='$pc',`dep`='$dep',`resp`='$resp',`team`='$team',`ram`='$ramal',`carg`='$carg',`loc`='$loc',`observar`='$desc' WHERE ip='$ip'") or die(mysql_error());
					echo "O cadastro foi alterado com sucesso!!!";

					return $query;
				} else {
					$query = mysqli_query($conn, $conn,"INSERT INTO `red_tel`(`cnpj`, `ip`, `host`, `dep`, `resp`, `team`, `ram`, `carg`, `loc`, `observar`) VALUES ('$cnpj', '$ip', '$pc', '$dep', '$resp', '$team','$ramal','$carg','$loc','$desc')") or die(mysql_error());
					echo "Operacao foi concluida com sucesso!!!";
					return $query;
				}
			}
		}
		function adicionar_dep($dep)
		{
			require("./conectar.php");
			$dep = strtoupper($dep);
			if (empty($dep)) {
				echo "<h4>favor verificar se o campo departamento foi preenchido!!!</h4>";
			} else {
				$resultado = mysqli_query($conn, "SELECT * FROM `depart` WHERE dep='$dep'");
				if (mysqli_num_rows($resultado)) {
					$query = mysqli_query($conn, $conn,"UPDATE `depart` SET `dep`='$dep' WHERE dep='$dep'") or die(mysql_error());
					echo "<h4>O cadastro foi alterado com sucesso!!!</h4>";
					return $query;
				} else {
					$query = mysqli_query($conn, $conn,"INSERT INTO `depart`(`dep`) VALUES ('$dep')") or die(mysql_error());
					echo "<h4>Operacao foi concluida com sucesso!!!</h4>";
					return $query;
				}
			}
		}

		function adicionar_impr($ip, $marca, $modelo, $local)
		{
			require("./conectar.php");
			$ip = strtoupper($ip);
			$marca = strtoupper($marca);
			$modelo = strtoupper($modelo);
			$local = strtoupper($local);

			if (empty($ip) || empty($marca) || empty($modelo) || empty($local)) {
				echo "<h4>Favor verificar se todos os campos foram preenchido!!</h4>";
			} else {
				$resultado = mysqli_query($conn, "SELECT * FROM impr WHERE ip = '$ip'");
				if (mysqli_num_rows($resultado)) {
					$query = mysqli_query($conn, $conn,"UPDATE `impr` SET `ip`='$ip',`loc`='$local',`marc`='$marca',`mode`='$modelo' WHERE ip='$ip'") or die(mysql_error());
					echo "<h4>O cadastro foi alterado com sucesso!!!</h4>";
					return $query;
				} else {
					$query = mysqli_query($conn, $conn,"INSERT INTO `impr`(`ip`,`marc`,`mode`,`loc`) VALUES ('$ip','$marca','$modelo','$local')") or die(mysql_error());
					echo "<h4>Operacao foi concluida com sucesso!!!</h4>";
					return $query;
				}
			}
		}
		function delete($ip)
		{
			require("./conectar.php");
			$resultado = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE ip='$ip'");
			if (mysqli_num_rows($resultado)) {
				$query = mysqli_query($conn, "DELETE FROM `red_tel` WHERE ip='$ip'");
				echo "<h4>Registro deletado!!!</h4>";
				return $query;
			} else {
				echo "<tr><td><h4>Error nao encontrado registro!!!</h4></td></tr>";
				return $query;
			}
		}
		function delete_impr($ip)
		{

			require("./conectar.php");
			$resultado = mysqli_query($conn, "SELECT * FROM `impr` WHERE ip='$ip'");
			if (mysqli_num_rows($resultado)) {
				$query = mysqli_query($conn, "DELETE FROM `impr` WHERE ip='$ip'");
				echo "<h4>Registro deletado!!!</h4>";
			} else {
				echo "<tr><td><h4>Error nao encontrado registro!!!</h4></td></tr>";
			}
		}

		function adicionar_sen_tel($nome, $senha)
		{
			require("./conectar.php");
			$nome = strtoupper($nome);
			if (empty($nome) || empty($senha)) {
				echo "<h4>Favor verificar se todos os campos foram preenchidos!!</h4>";
			} else {
				$resultado = mysqli_query($conn, "SELECT * FROM `tel_sen` WHERE senha='$senha'");
				if (mysqli_num_rows($resultado)) {
					$query = mysqli_query($conn, $conn,"UPDATE `tel_sen` SET `Nome`='$nome' WHERE Senha='$senha'") or die(mysql_error());
					echo "<h4>O cadastro foi alterado com sucesso!!!</h4>";

					return $query;
				} else {
					$query = mysqli_query($conn, $conn,"INSERT INTO `tel_sen`(`Nome`, `Senha`) VALUES ('$nome', '$senha')") or die(mysql_error());
					echo "<h4>Operacao foi concluida com sucesso!!!</h4>";
					return $query;
				}
			}
		}
		function adicionar_secret($prod, $area, $dica, $usu, $sen, $desc)
		{
			require("./conectar.php");
			$prod = strtoupper($prodj);
			$area = strtoupper($area);
			$dica = strtoupper($usu);
			$usu = strtoupper($sen);
			$sen = strtoupper($resp);
			$desc = strtoupper($desc);
			if (empty($prod) || empty($area) || empty($dica) || empty($usu) || empty($sen) || empty($desc)) {
				echo "<h4>favor verificar se todos os campos foram preenchidos!!!</h4>";
			} else {
				$resultado = mysqli_query($conn, "SELECT * FROM `infor_secret` WHERE equip_prod='$prod'");
				if (mysqli_num_rows($resultado)) {


					$query = mysqli_query($conn, $conn, $conn,"UPDATE `infor_secret` SET `equip_prod`='$prod',`area`='$area',`dica`='$dica',`usuario`='$usu',`senha`='$sen',`infor_imp`='$desc' WHERE euip_prod='$prod'") or die(mysql_error());
					echo "<h4>O cadastro foi alterado com sucesso!!!</h4>";

					return $query;
				} else {
					$query = mysqli_query($conn, $conn,"INSERT INTO `red_tel`(`cnpj`, `ip`, `host`, `dep`, `resp`, `team`, `ram`, `carg`, `loc`, `observar`) VALUES ('$cnpj', '$ip', '$pc', '$dep', '$resp', '$team','$ramal','$carg','$loc','$desc')") or die(mysql_error());
					echo "Operacao foi concluida com sucesso!!!";
					return $query;
				}
			}
		}
		function lista_dados($item)
		{
			require("./conectar.php");
			$query = mysqli_query($conn, "SELECT $item FROM `red_tel` WHERE  1");
			while ($monta = mysqli_fetch_assoc($query)) {
				echo '<option value="' . $monta[($item)] . '">' . $monta[($item)] . '</option>';
			}
		}
		function lista_C($campo, $busca, $nivel, $tipo_t)
		{
			require("./conectar.php");
			if (empty($campo)) {
				$query = mysqli_query($conn, "SELECT * FROM  `red_tel` WHERE ram <> '0' order by host asc");
			} else {
				if ($nivel == 2) {
					$tipo_t == "Re";
					$query = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE  $campo like '$busca%' order by host asc");
				} else {
					$tipo_t == "R";
					$query = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE  $campo like '$busca%' and ram <> '0' order by host asc");
				}
			}

			if (mysqli_num_rows($query)) {
				$estilos[] = "text-align: center; background-color: rgb(128,128,128);font-size:13px";
				$estilos[] = "text-align: center;font-size:13px";
				$estilos[] = "text-align: center;font-size:13px width: 200%";
				if ($nivel == 2) {
					if ($tipo_t == "R") {
						echo "<table style=\"width: 50%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
							<td style=\"$estilos[0]\">USUARIO(A)</td>
							<td style=\"$estilos[0]\">RAMAL</td>
							<td style=\"$estilos[0]\">LOCAL</td>
							<td style=\"$estilos[0]\">DEPART</td>
							";
					} else {
						echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
							<td style=\"$estilos[0]\">IP</td>
							<td style=\"$estilos[0]\">PC</td>
							<td style=\"$estilos[0]\">DEPART</td>
							<td style=\"$estilos[0]\">USUARIO(A)</td>
							<td style=\"$estilos[0]\">TEAMVIEW</td>
							<td style=\"$estilos[0]\">RAMAL</td>
							<td style=\"$estilos[0]\">CARGO</td>
							<td style=\"$estilos[0]\">LOCAL</td>
							<td style=\"$estilos[0]\">DESCR</td>
					";
					}
				} else {

					echo "<table style=\"width: 80%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					
					<td style=\"$estilos[0]\">USUARIO(A)</td>
					<td style=\"$estilos[0]\">RAMAL</td>
					<td style=\"$estilos[0]\">LOCAL</td>
					<td style=\"$estilos[0]\">DEPART</td>
					";
				}
				while ($array = mysqli_fetch_row($query)) {
					$resultado = "";
					if ($nivel == 2) {
						if ($tipo_t == "R") {
							echo "<tr>
										<td style=background-color:white align=center>$array[3]</td>
										<td style=background-color:white align=center>$array[5]</td>
										<td style=background-color:white align=center>$array[7]</td>
										<td style=background-color:white align=center>$array[2]</td>
										</tr>";
						} else {

							$string = $array[1];
							$resultado = "$string[0]$string[1]$string[2]";
							switch ($resultado) {
								case "DIM":
									$link = "background-color:green align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "UNI":
									$link = "background-color:yellow align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "CON":
									$link = "background-color:#CCEEFF align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "INT":
									$link = "background-color:grey align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "SRV":
									$link = "background-color:brown align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "CAM":
									$link = "background-color:purple align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "SOP":
									$link = "background-color:red align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "WKS":
									$link = "background-color:#81BEF7 align=center font-size:13px";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "WKE":
									$link = "background-color:#FE2E9A align=center font-size:13px";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								default:
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
										</tr>";
									break;
							}
						}
					} else {
						echo "<tr>
							<td style=background-color:white align=center>$array[3]</td>
							<td style=background-color:white align=center>$array[5]</td>
							<td style=background-color:white align=center>$array[7]</td>
							<td style=background-color:white align=center>$array[2]</td>
							</tr>";
					}
				}
				echo "<tr><td style=\"$estilos[0]\"> Informacoes Importantes</td></tr>";
			} else {
				echo "<p>Nenhum registro foi encontrado!!</p>";
			}
			return $query;
		}
		function lista($campo, $busca, $nivel, $tipo_t)
		{
			require("./conectar.php");
			if (empty($campo)) {
				$query = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE ram <> '0' order by host asc");
			} else {
				if ($nivel <> 2) {
					$query = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE  $campo like'$busca%' and ram <> '0' order by carg asc");
				} else {
					if ($tipo_t == "R") {
						$query = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE  $campo like'$busca%' and ram <> '0' order by carg asc");
					} else {
						$query = mysqli_query($conn, "SELECT * FROM `red_tel` WHERE  $campo like'$busca%'  order by carg asc");
					}
				}
			}

			if (mysqli_num_rows($query)) {
				$estilos[] = "text-align: center; background-color: rgb(128,128,128);font-size:13px";
				$estilos[] = "text-align: center;font-size:13px";
				$estilos[] = "text-align: center;font-size:13px width: 200%";
				if ($nivel == 2) {
					if ($tipo_t == "R") {
						echo "<table style=\"width: 50%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					
							<td style=\"$estilos[0]\">USUARIO(A)</td>
							<td style=\"$estilos[0]\">RAMAL</td>
							<td style=\"$estilos[0]\">LOCAL</td>
							<td style=\"$estilos[0]\">DEPART</td>
							";
					} else {
						echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
							<td style=\"$estilos[0]\">IP/PC</td>
							<td style=\"$estilos[0]\">DEPART</td>
							<td style=\"$estilos[0]\">USUARIO(A)</td>
							<td style=\"$estilos[0]\">TEAMVIEW/ANYDESK</td>
							<td style=\"$estilos[0]\">RAMAL</td>
							<td style=\"$estilos[0]\">FUNC</td>
							<td style=\"$estilos[0]\">LOCAL</td>
							<td style=\"$estilos[0]\">DESCR</td>
					";
					}
				} else {

					echo "<table style=\"width: 80%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					
					<td style=\"$estilos[0]\">USUARIO(A)</td>
					<td style=\"$estilos[0]\">RAMAL</td>
					<td style=\"$estilos[0]\">LOCAL</td>
					<td style=\"$estilos[0]\">DEPART</td>
					";
				}
				while ($array = mysqli_fetch_row($query)) {
					$resultado = "";
					if ($nivel == 2) {
						if ($tipo_t == "R") {
							echo "<tr>
										<td style=background-color:white align=center>$array[3]</td>
										<td style=background-color:white align=center>$array[5]</td>
										<td style=background-color:white align=center>$array[7]</td>
										<td style=background-color:white align=center>$array[2]</td>
										</tr>";
						} else {
							error_reporting(0);
							$string = $array[1];
							$resultado = "$string[0]$string[1]$string[2]";

							switch ($resultado) {
								case "DIM":
									$link = "background-color:green align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "UNI":
									$link = "background-color:yellow align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "CON":
									$link = "background-color:#CCEEFF align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "INT":
									$link = "background-color:grey align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "SRV":
									$link = "background-color:brown align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "CAM":
									$link = "background-color:purple align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "SOP":
									$link = "background-color:red align=center";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "WKS":
									$link = "background-color:#81BEF7 align=center font-size:13px";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								case "WKE":
									$link = "background-color:#FE2E9A align=center font-size:13px";
									echo "<tr>
										<td style=$link><font size=2>$array[0]</font></td>
										<td style=$link><font size=2>$array[1]</font></td>
										<td style=$link><font size=2>$array[2]</font></td>
										<td style=$link><font size=2>$array[3]</font></td>
										<td style=$link><font size=2>$array[4]</font></td>
										<td style=$link><font size=2>$array[5]</font></td>
										<td style=$link><font size=2>$array[6]</font></td>
										<td style=$link><font size=2>$array[7]</font></td>
										<td style=$link><font size=2>$array[8]</font></td>
										</tr>";
									break;
								default:
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
										</tr>";
									break;
							}
						}
					} else {
						echo "<tr>
							<td style=background-color:white align=center>$array[3]</td>
							<td style=background-color:white align=center>$array[5]</td>
							<td style=background-color:white align=center>$array[7]</td>
							<td style=background-color:white align=center>$array[2]</td>
							</tr>";
					}
				}
				echo "<tr><td style=\"$estilos[0]\"> Informacoes Importantes</td></tr>";
				echo "<tr><td style=\"$estilos[0]\"> <b> <a href='#topo'>Volta ao topo!</a></b></td></tr>";
			} else {
				echo "<p>Nenhum registro foi encontrado!!</p>";
			}
			return $query;
		}
		function apar_wke($busca)
		{
			require("./conectar.php");
			$b = "IOL";
			$c = "Galilei";
			$d = "wks-stratus";
			$tipoL = "CLINICA";
			$tip = "";
			$query = mysqli_query($conn, "SELECT ip,host,loc FROM `red_tel` WHERE  host like '$busca%' or host like '$b%' or host like '$c%' or host like '$d%' order by loc asc");
			if (mysqli_num_rows($query)) {
				$estilos[] = "text-align: center; background-color: rgb(128, 128, 128);font-size:13px";
				$estilos[] = "text-align: center;font-size:13px";
				echo "<table style=\"width: 50%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\">IP</td>
					<td style=\"$estilos[0]\">Aparelho</td>
					<td style=\"$estilos[0]\">Local</td>
					";
				$total = 0;
				$tip = "";
				$vsl = "";
				while ($array = mysqli_fetch_row($query)) {
					$tip = $array[2];
					if ($tip == "CLINICA") {
						$vsl = "L2 SUL";
					}
					if ($tip == "CLINICA TAG") {
						$vsl = "TAGUATINGA";
					}

					echo "<tr>
							<td style=background-color:yellow align=center>$array[0]</td>
							<td style=background-color:yellow align=center>$array[1]</td>
							<td style=background-color:yellow align=center>$vsl</td>
							</tr>";
					$total = $total + 1;
				}
				echo "<tr><td style=\"$estilos[0]\"> Total: $total</td> </tr>";
			} else {
				echo "nenhum registro foi encontrado !!";
			}
			return $query;
		}
		function lista_docs($entrada, $saida)
		{
			require("./conectar.php");
			$query = mysqli_query($conn, "SELECT * FROM movi_c WHERE dt_sai >= '$entrada' and dt_sai <= '$saida' order by dt_sai asc");
			if (mysqli_num_rows($query)) {
				$estilos[] = "text-align: center; background-color: rgb(128, 128, 128);font-size:13px";
				$estilos[] = "text-align: center;font-size:13px";
				echo "<table style=\"width: 90%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\">CODIGO</td>
					<td style=\"$estilos[0]\">EQUIP.</td>
					<td style=\"$estilos[0]\">ENTRADA</td>
					<td style=\"$estilos[0]\">SAIDA</td>
					<td style=\"$estilos[0]\">SETOR</td>
					<td style=\"$estilos[0]\">COLABORADOR</td>
					<td style=\"$estilos[0]\">DESTINO</td>
					<td style=\"$estilos[0]\">ENTREGADOR</td>
					<td style=\"$estilos[0]\">TIPO</td>
					<td style=\"$estilos[0]\">MODELO</td>
					<td style=\"$estilos[0]\">UNID.</td>
					<td style=\"$estilos[0]\">OBS</td>
					";
				$total = 0;
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
					$total = $total + 1;
				}
				echo "<tr><td style=\"$estilos[0]\"> Total: $total</td> </tr>";
			} else {
				echo "nenhum registro foi encontrado talvez os campos nao sejam compativeis com a pesquisa realizada!!";
				return $query;
			}
		}
		function impressoras()
		{
			require("./conectar.php");
			$query = mysqli_query($conn, "SELECT * FROM  `impr` WHERE 1 order by loc asc");
			if (mysqli_num_rows($query)) {
				$total = 0;
				$estilos[] = "text-align: center; background-color: rgb(128,128,128);font-size:13px";
				$estilos[] = "text-align: center;font-size:13px";
				$estilos[] = "text-align: center;font-size:13px width: 200%";
				echo "<table style=\"width: 70%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\">IP</td>
					<td style=\"$estilos[0]\">Marca</td>
					<td style=\"$estilos[0]\">Modelo</td>
					<td style=\"$estilos[0]\">Local</td>
					</tr>";
				while ($array = mysqli_fetch_row($query)) {
					echo "<tr>
					<td style=background-color:white align=center><a href=http://$array[0]/>Site Impressora - IP: </a>$array[0]</td>
					<td style=background-color:white align=center>$array[2]</td>
					<td style=background-color:white align=center>$array[3]</td>
					<td style=background-color:white align=center>$array[1]</td>
					</tr>";
					$total = $total + 1;
				}
				echo "<tr><td style=\"$estilos[0]\"> Informacoes de impressoras:{$total}</td></tr>";
			} else {
				echo "<p>Nenhum registro foi encontrado!!</p>";
			}
			return $query;
		}
		function seg_pesq($busca)
		{
			require("./conectar.php");
			$query = mysqli_query($conn, "SELECT * FROM `infor_secret` WHERE  equip_prod='$busca' ");
			if (mysqli_num_rows($query)) {
				while ($array = mysqli_fetch_row($query)) {
					$equip = $array[0];
					$area  = $array[1];
					$usuario = $array[2];
					$senha = $array[3];
					$dica = $array[4];
					$infor = $array[5];
				}
			}
		}
		function delete_seg($equip)
		{
			require("./conectar.php");
			$resultado = mysqli_query($conn, "SELECT * FROM `infor_secret` WHERE equip_prod='$equip'");
			if (mysqli_num_rows($resultado)) {
				$query = mysqli_query($conn, $conn, "DELETE FROM `infor_secret` WHERE equip_prod='$equip'");
				echo "Registro deletado!!!";
			} else {
				echo "<tr><td>Error nao encontrado registro!!!</td></tr>";
			}
		}
		function imprimir($campo, $busca, $nivel)
		{
			require("./conectar.php");
			if (empty($campo)) {
				$query = mysqli_query($conn, "SELECT * FROM  `impr` WHERE 1 order by loc asc");
			} else {
				$query = mysqli_query($conn, "SELECT * FROM `impr` WHERE  $campo='$busca' order by loc asc");
			}

			if (mysqli_num_rows($query)) {
				$total = 0;
				$estilos[] = "text-align: center; background-color: rgb(255,255,255);font-size:13px";
				$estilos[] = "text-align: center;font-size:13px;color:black";
				$estilos[] = "text-align: center;font-size:13px width: 200%";
				print "<table style=\"width: 80%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\">IP</td>
					<td style=\"$estilos[0]\">Marca</td>
					<td style=\"$estilos[0]\">Modelo</td>
					<td style=\"$estilos[0]\">Local</td>
					</tr>";
				while ($array = mysqli_fetch_row($query)) {
					$nome = $array[0];
					$parte = substr($nome, 0, 1);
					if ($parte == 1) {
						print "<tr>
                <td style=\$estilos[1]\><a href=http://$array[0]/> Site Impressora - IP: </a> $array[0] </td>
                <td style=background-color:white align=center>$array[2]</td>
                <td style=background-color:white align=center>$array[3]</td>
                <td style=background-color:white align=center>$array[1]</td>
                </tr>";
					} else {
						print "<tr>
                 <td style=background-color:white align=center>$array[0]</td>
                <td style=background-color:white align=center>$array[2]</td>
                <td style=background-color:white align=center>$array[3]</td>
                <td style=background-color:white align=center>$array[1]</td>
                </tr>";
					}

					$total = $total + 1;
				}
				print "<tr><td style=\"$estilos[0]\"> Informacoes de impressoras:{$total}</td></tr>";
			} else {
			}
			return $query;
		}

		function lista_impr($campo, $busca, $nivel)
		{
			require("./conectar.php");
			if (empty($campo)) {
				$query = mysqli_query($conn, "SELECT * FROM  `impr` WHERE 1 order by loc asc");
			} else {
				$query = mysqli_query($conn, "SELECT * FROM `impr` WHERE  $campo='$busca' order by loc asc");
			}

			if (mysqli_num_rows($query)) {
				$total = 0;
				$estilos[] = "text-align: center; background-color: rgb(90,96,113);font-size:14px;color:white";
				$estilos[] = "text-align: center;font-size:14px;color:black";
				$estilos[] = "text-align: center;font-size:14px width: 200%";
				echo "<table style=\"width: 80%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
					<td style=\"$estilos[0]\">IP</td>
					<td style=\"$estilos[0]\">Marca</td>
					<td style=\"$estilos[0]\">Modelo</td>
					<td style=\"$estilos[0]\">Local</td>
					</tr>";
				while ($array = mysqli_fetch_row($query)) {
					$nome = $array[0];
					$parte = substr($nome, 0, 1);
					if ($parte == 1) {
						echo "<tr>
                <td style=background-color:white align=center><a href=http://$array[0]/> Site Impressora - IP: </a> $array[0] </td>
                <td style=background-color:white align=center>$array[2]</td>
                <td style=background-color:white align=center>$array[3]</td>
                <td style=background-color:white align=center>$array[1]</td>
                </tr>";
					} else {
						echo "<tr>
                 <td style=background-color:white align=center>$array[0]</td>
                <td style=background-color:white align=center>$array[2]</td>
                <td style=background-color:white align=center>$array[3]</td>
                <td style=background-color:white align=center>$array[1]</td>
                </tr>";
					}

					$total = $total + 1;
				}
				echo "<tr><td style=background-color:white align=center> Informacoes de impressoras:{$total}</td></tr>";
			} else {
			}
			return $query;
		}
	}
	?>
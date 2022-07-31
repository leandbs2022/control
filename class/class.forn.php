	<?php

	$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
	class forn
	{
		function adicionar_forn($cnpj, $empr, $tel, $contato, $cel, $serv, $cep, $ende, $bair, $cid, $infor, $situa, $id)
		{
			require("./conectar.php");
			$cnpj = strtoupper($cnpj);
			$empr = strtoupper($empr);
			$tel = strtoupper($tel);
			$contato = strtoupper($contato);
			$cel = strtoupper($cel);
			$serv = strtoupper($serv);
			$cep = strtoupper($cep);
			$ende = strtoupper($ende);
			$bair = strtoupper($bair);
			$cid = strtoupper($cid);
			$infor = strtoupper($infor);
			$situa = strtoupper($situa);

			if (empty($cnpj)) {
				$cnpj = 0;
			}
			if (empty($empr) || empty($situa)) {
				echo "favor verificar se todos os campos foram preenchido!!!";
			} else {
				$resultado = mysqli_query($conn, "UPDATE* FROM forne_terc WHERE id='$id'");
				if (mysqli_num_rows($resultado)) {
					$query = mysqli_query($conn, "UPDATE `forne_terc` SET `emp`='$empr',`cnpj_emp`='$cnpj',`tel`='$tel',`cont`='$contato',`cel_tel`='$cel',`prod_serv`='$serv',`cep`='$cep',`logr`='$ende',`bai`='$bair',`cid`='$cid',`obs`='$infor',`ative`='$situa' WHERE id='$id'") or die(mysql_error());
					echo "<h6>O cadastro foi alterado com sucesso!!!</h6>";
					return $query;
				} else {
					$query = mysqli_query($conn, "INSERT INTO `forne_terc`(`emp`, `cnpj_emp`, `tel`, `cont`, `cel_tel`, `prod_serv`, `cep`, `logr`, `bai`, `cid`, `obs`, `ative`, `id`) VALUES ('$empr','$cnpj','$tel','$contato','$cel','$serv','$cep','$ende','$bair','$cid','$infor','$situa','$id')") or die(mysql_error());
					echo "<h6>Operacao foi concluida com sucesso!!!</h6>";
					return $query;
				}
			}
		}
		function delete_forn($id)
		{
			require("./conectar.php");
			$resultado = mysqli_query($conn, "UPDATE* FROM `forne_terc` WHERE id='$id'");
			if (mysqli_num_rows($resultado)) {
				$query = mysqli_query($conn,"DELETE FROM `forne_terc` WHERE id='$id'");
				echo "Registro deletado!!!";
				return $query;
			} else {
				echo "<tr><td>
							<h6>Error nao encontrado registro!!!</h6></td></tr>";
				return $query;
			}
		}
		function lista()
		{
			require("./conectar.php");
			$query = mysqli_query($conn,"SELECT * FROM `forne_terc` WHERE 1 order by emp cnpj_emp asc") or die(mysqli_error($conn));
			if (mysqli_num_rows($query)) {
				$estilos[] = "text-align: center; background-color: rgb(128, 128, 128);font-size:13px";
				$estilos[] = "text-align: center;font-size:13px";
				$estilos[] = "text-align: center;font-size:13px width: 200%";
				echo "<table style=\"width: 101%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
						<td style=\"$estilos[0]\">ID</td>
						<td style=\"$estilos[0]\">EMPRESA</td>
						<td style=\"$estilos[0]\">TELEFONE</td>
						<td style=\"$estilos[0]\">CONTATO</td>
						<td style=\"$estilos[0]\">CELULAR/TEL</td>
						<td style=\"$estilos[0]\">AREA</td>
						<td style=\"$estilos[0]\">INFOR. IMPORTANTES</td>
						";
				while ($array = mysqli_fetch_row($query)) {
					echo "<tr>								
								<td style=background-color:WHITE align=center>$array[0]</td>
								<td style=background-color:WHITE align=center>$array[1]</td>
								<td style=background-color:WHITE align=center>$array[3]</td>
								<td style=background-color:WHITE align=center>$array[4]</td>
								<td style=background-color:WHITE align=center>$array[5]</td>
								<td style=background-color:WHITE align=center>$array[6]</td>
								<td style=background-color:WHITE align=center>$array[11]</td>
								</tr>";
				}
				echo "<tr><td style=\"$estilos[0]\"> Informacoes de fornecedores</td></tr>";
			} else {
				echo "<h6>nenhum registro foi encontrado!!</h6>";
			}
			return $query;
		}
	}
	?>
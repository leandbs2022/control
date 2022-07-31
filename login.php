<?php
$query = mysqli_query("SELECT * FROM login WHERE id=1");
if($key != mysql_result($query, 0, "key")) {
	$senha_incorreta = "<br><p align=\"center\" style=\"color: #FF0000; font-size:16px;\">Senha incorreta!<br><a href=\"index.php\">Voltar</a></p>";
} else {
	
	$autenticado = TRUE;
}
?>
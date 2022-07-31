<?php

class DB {
	function conectar ($host, $port, $user, $password, $database) {
		@ $link = mysql_connect($server.":".$port, $user, $password);
		if (!$link) {
			die("Não foi possível conectar-se ao SGDB MySQL, por favor contate o Administrador do Sistema: ".mysql_error());
		}
		@ $selectdb = mysql_select_db($database, $link);
		if (!$selectdb) {
			die("Não foi possível selecionar o Banco de Dados. <br /><br /> ".mysql_error());
		}
	}
}

?>
<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
if(isset($_SESSION['utilizador']))
	{
    	$nome = "$_SESSION[utilizador]";
	}
	
		if(empty($nome))
		{
			echo "Favor efetuar logoff antes de evisar mensagem!!!!";
		}
		else
		{
		$nome = "$_SESSION[utilizador]";
		$data = date('d-m-Y H:i');
		$mensagem = $_POST["mensagem"];
		$msg .= "<br><font color=#000000><b>Responsavel:</b>$nome</font><br>";
		$msg .= "<font color=#000000>............................................................................................</font>";
		$msg .= "<br><font color=#000000><b>Enviada em:</b>$data</font><br>";
		$msg .= "<font color=#000000><b>Aviso:</b>$mensagem</font><br>";
		$msg .= "<br>";
		$msg .= "<font color=#000000>............................................................................................</font>";
		$ponteiro = fopen ("mensagens.txt", "a");
		fwrite($ponteiro, "$msg\n\n");
		fclose ($ponteiro);
	}
?>
<div align="center">Sua mensagem foi enviada com sucesso!
  <BR>
  Agradecemos sua visita.
  </h3>
</div>
<p>
<a href="mensagens.php"> Voltar </a>


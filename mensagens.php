<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mensagem</title>
</head>
<script>
function rolar(){
window.scrollBy(0,01);
velocidade = setTimeout('rolar()',50);
}
</script>
<td><?php include "mensagens.txt"; ?></FONT></td>
<p> </p>
<body  onload="rolar()">
</body>
</html>

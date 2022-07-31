
<?php 
session_start();
$link = "";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Imprimir </title>
</head>
<?php 
	$link =$_SESSION['exec'] ;
	echo $link;
	echo "<img src=img/Prev_NFe/$link.jpg width=720 height=1080 alt= descrição da imagem/>";
?>
<script type="text/javascript">
        window.print();
        //window.close(); Só descomente esta linha se tiver o modo kiosk habilitado
    </script>
<body>
<form id="form1" name="form1" method="post" action="">
  <input type="submit" name="imprimir" id="imprimir" value="Imprimir " />
</form>
</body>
</html>

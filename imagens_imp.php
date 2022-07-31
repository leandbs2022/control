
<?php 
session_start();
$link = $_SESSION['impressao'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <script type="text/javascript">
        window.print();
        //window.close(); Só descomente esta linha se tiver o modo kiosk habilitado
 </script>
</head>
<body>
<?php 
<div style="" align="center">
echo "<img src=img/NFe/$link.jpg  alt= descrição da NFe/>";
</div>
?>
</body>
</html>

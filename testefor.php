<?php

$yes = 0;
$num = 6;
$res = 1;
for ($i = 1; $i <= 10; $i++) {
  $res = $num * $i;
  echo $num . "x" . $i . "=" . $res . "<br>";
}

$i = 1;
$num = "1";
$NUM = "2";
while ($i <= 10) {
  if ($i % 2 == 0) {

    echo $i . "<br>" . $NUM . $num;
  }
  $i++;
}

$a = 33;
$b = 15;
$c = 2;
$d = 9;

$b = $c--;
$a = --$b;
$d = 0;
$a -= $d;
//setcookie()
?>
<html>

<head>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <div class="container">
      <p>
        <input type="text" name="txtloc" id="txtloc" class="" value="" />
        <input type="submit" name="LOC" id="LOC" class="" value="Adicionar dados" />
      </p>
      <p>
        <input type="text" name="txtloc01" id="txtloc01" class="" value="" />
        <input type="submit" name="LOC01" id="LOC01" class="" value="dias" />

        <?php
        if (isset($_POST['LOC01'])) {
          //Variaveis
          $seg = "Monday";
          $ter = "Tuesday";
          $qua = "Wednesday";
          $qui = "Thursday";
          $sex = "Friday";
          $sab = "Saturday";
          $dom = "Sunday";

          $dados = $_POST['txtloc01'];
          $aponta  = date("l");

          switch ($aponta) {
            case $seg:
              $aponta = "Segunda";
              break;
            case $ter:
              $aponta = "Terça";
              break;
            case $qua:
              $aponta = "Quarta";
              break;
            case $qui:
              $aponta = "Quinta";
              break;
            case $sex:
              $aponta = "Sexta";
              break;
            case $sab:
              $aponta = "Sabado";
              break;
            case $dom:
              $aponta = "Domingo";
              break;
          }
          $pos = strpos($dados, $aponta);
          if ($pos === false) {
            echo 'Não há dia atual na sua pesquisa';
          } else {
            echo "hoje é {$aponta}";
          }
        }
        ?>
      </p>
      <p>
        <select name="cmb01">
          <?php
          $file = file("cfg/base.txt");
          for ($i = 0; $i < count($file); $i++) {
            echo "\t<option value=\"$i\">" . trim($file[$i]) . "</option>\n";
          }
          ?>
        </select>
        <input type="submit" name="delete" id="delete" class="" onclick="Myclick()" value="Deletar Informações" />
      </p>
      <p>
        <?php
        if (isset($_POST['LOC'])) {
          $msg = $_POST['txtloc'];
          $msg = strtoupper($msg);
          if (empty($msg)) {
          } else {
            if (strpos(file_get_contents("cfg/base.txt"), $msg) !== false) {
              echo "<p>Essa informação ja existe</p><br>";
            } else {
              $myfile = fopen("cfg/base.txt", "a");
              fwrite($myfile, $msg . "\n");
              fclose($myfile);
            }
          }
        }


        ?>
      </p>
    </div>
  </form>
  <script>
    function Myclick() {

      if (confirm("deseja deleta as informações e reconfigurar?") === true) {
        $yes = true;

      } else {
        $yes = false;
      }
    }
  </script>
</body>

</html>
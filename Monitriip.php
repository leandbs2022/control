
<html>
<head>
</head>
<body>
  <form id="form1" name="form1" method="post" action="">
    <div class="container">
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
        //Comparações Inglês para português os dias
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
          //confirmar se encontrar ou não se e dia atual
          $pos = strpos($dados, $aponta);
          if ($pos === false) {
            echo 'Não há dia atual na sua pesquisa';
          } else {
            echo "hoje é {$aponta}";
          }
        }
        ?>
      </p>
    </div>
  </form>
</body>
</html>
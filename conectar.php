
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cst";

//Create connection
$conn= mysqli_connect($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>

<?php
/*require("./class/class.DB.php");
# variáveis para conectar-se ao banco de dados...
$host = "localhost";
$port = 3306;
$user = "root";
$password = "";
$database = "cst";
$db = new DB;
$db->conectar($host, $port, $user, $password, $database);*/
?>
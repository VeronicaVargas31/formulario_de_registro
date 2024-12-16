<?php 
$user = "root";
$password = "123456789";
$database = "hello_mysql";
$host = "localhost";


$conection = mysqli_connect($host, $user, $password, $database);
if (!$conection) {
    die(json_encode(["error" => "Conexion fallida: " . mysqli_connect_error()]));
}

$sql = "SELECT * FROM formulario_de_registro LIMIT 3";
$result = mysqli_query($conection, $sql);


?>
 


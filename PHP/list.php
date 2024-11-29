<?php 
$user = "root";
$password = "123456789";
$database = "hello_mysql";
$host = "localhost";


$conection = mysqli_connect($host, $user, $password, $database);
if (!$conection) {
    die(json_encode(["error" => "Conexion fallida: " . mysqli_connect_error()]));
}

$sql = "SELECT * FROM formulario_de_registro";
$result = mysqli_query($conection, $sql);


$usuarios = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $usuarios[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode($usuarios);

?>

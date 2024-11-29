<?php //obtener_usuario.php
$user = "root";
$password = "123456789";
$database = "hello_mysql";
$host = "localhost";

$conection = mysqli_connect($host, $user, $password, $database);
if (!$conection) {
    die(json_encode(["success" => false, "error" => "Conexión fallida: " . mysqli_connect_error()]));
}

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM formulario_de_registro WHERE formulario_de_registro_id = $id";
    $result = mysqli_query($conection, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Usuario no encontrado"]);
    }
} else {
    echo json_encode(["error" => "ID no proporcionado"]);
}
?>





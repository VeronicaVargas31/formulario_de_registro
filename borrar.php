<?php
$user = "root";
$password = "123456789";
$database = "hello_mysql";
$host = "localhost";

$conection = mysqli_connect($host, $user, $password, $database);
if (!$conection) {
    die(json_encode(["error" => "conexion fallida:" . mysqli_connect_error()]));
}
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM formulario_de_registro WHERE formulario_de_registro_id = ?";
    $stmt = mysqli_prepare($conection, $sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {                                         
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $conection->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "ID no válido"]);
}



?>

  



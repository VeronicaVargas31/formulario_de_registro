<?php  
$user = "root";
$password = "123456789";
$database = "hello_mysql";
$host = "localhost";

$conection = mysqli_connect($host, $user, $password, $database);
if (!$conection) {
    die(json_encode(["success" => false, "error" => "Conexión fallida: " . mysqli_connect_error()]));
}

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $nombre_completo = $_POST['nombre_completo'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $ocupacion = $_POST['ocupacion'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE formulario_de_registro SET nombre_completo = ?, genero = ?, fecha_nacimiento = ?, pais = ?, ciudad = ?, ocupacion = ?, direccion = ?, email = ?, phone = ? 
    WHERE formulario_de_registro_id = ?";


    if ($stmt = mysqli_prepare($conection, $sql)) {
        $stmt->bind_param('sssssssssi', $nombre_completo, $genero, $fecha_nacimiento, $pais, $ciudad, $ocupacion, $direccion, $email, $phone, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Error en ejecución: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Error en la preparación: " . $conection->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID no válido o no proporcionado"]);
}


?>

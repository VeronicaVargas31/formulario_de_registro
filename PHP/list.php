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
        $row['botons'] = '<button class="btn-editar btn btn-primary" data-id="' . $row['formulario_de_registro_id'] . '" data-bs-toggle="modal" data-bs-target="#editar">Editar</button>
        <button class="btn btn-outline-dark" onclick="deleteUser(' . $row['formulario_de_registro_id'] . ')">Eliminar</button>
        <a href="PHP/fpdf.php?id=' . $row['formulario_de_registro_id'] . '" class="btn btn-secondary"><i class="bi bi-arrow-down-circle"></i>PDF</a>';
        $usuarios[] = $row;
    }
}
header('Content-Type: application/json');
echo json_encode(['data' => $usuarios]);
?>

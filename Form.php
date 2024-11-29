<?php


$user = "root";
$password = "123456789";
$database = "hello_mysql";
$host = "localhost";


// Crear conexión
$conection = mysqli_connect($host, $user,$password, $database );
if (!$conection) {

    echo ("conexion fallida: ");
}

$nombre = $_POST['nombre'] ?? '';
$primer_apellido = $_POST['primer_apellido'] ?? '';
$segundo_apellido = $_POST['segundo_apellido'] ?? '';
$genero = $_POST['genero'] ?? '';
$fecha_nacimiento = $_POST['fecha_de_nacimiento'] ?? '';
$pais = $_POST['pais'] ?? '';
$ciudad = $_POST['ciudad'] ?? '';
$ocupacion = $_POST['ocupacion'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

$nombre_completo = $nombre . " " . $primer_apellido . " " . $segundo_apellido;
if (
    empty($nombre_completo) ||empty($genero) ||empty($fecha_nacimiento) ||
    empty($pais) || empty($ciudad) || empty($ocupacion) || empty($direccion) ||
    empty($email) || empty($phone)
) {
    echo "Por favor, complete todos los campos del formulario.";
    exit(); 
}
$insertar = "INSERT INTO formulario_de_registro (nombre_completo, genero, fecha_nacimiento, pais, ciudad, ocupacion, direccion, email, phone)
        VALUES ('$nombre_completo', '$genero', '$fecha_nacimiento', '$pais', '$ciudad', '$ocupacion', '$direccion', '$email', '$phone')";

$query = mysqli_query($conection, $insertar);

if ($query) {

    echo "Registro guardado exitosamente.";
} else {
    echo "Error al guardar el registro: ";

}

?>



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

$rows = $result -> fetch_all(MYSQLI_ASSOC);




// Sección para descargar el archivo CSV 
    $filename = "exportar_formulario.csv" ; 
    $delimiter = "," ; 
    $f = fopen ( 'php://memory' , 'w' ); 
    $fields = array_keys ( current ( $rows )); 
    fputcsv ( $f , $fields , $delimiter ); 
    foreach ( $rows  as  $row ) { 
        fputcsv ( $f , $row , $delimiter ); 
    } 
    fseek ( $f , 0 ); 
    header ( 'Content-Type: text/csv'); 
    header ( 'Content-Disposition: attached; filename="' . $filename . '";' ); 
    fpassthru ( $f ); 
    fclose ( $f ); 
    exit ; 

?>
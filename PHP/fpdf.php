<?php

require 'datos_de_usuario.php';
require('../fpdf186/fpdf.php');

$pdf = new FPDF('L', 'mm', 'A3');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 30);

$pdf->Text(10, 20, 'Datos del Usuario:');
$pdf->Ln(30);

$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(226, 167, 240 );
$pdf->SetTextColor(0, 0, 0);


$widths = [15, 50, 30, 45, 25, 45, 40, 40, 50, 40];

$columns = ['ID','Nombre Completo','Genero','Fecha de Nacimiento','Pais','Ciudad','Ocupacion','Direccion','Email','Phone'];

$datos = [$row['formulario_de_registro_id'], $row['nombre_completo'], $row['genero'], $row['fecha_nacimiento'], $row['pais'], $row['ciudad'], $row['ocupacion'], $row['direccion'], $row['email'], $row['phone']];


foreach ($columns as $index => $columns) {
    $pdf->Cell($widths[$index], 18, $columns, 1, 0, 'C', true);
}
$pdf->Ln();


foreach ($datos as $index => $value) {
    $pdf->Cell($widths[$index], 15, $value, 1, 0, 'C');
}
$pdf->Ln();


$pdf->Output('I', 'Usuario_Informacion.pdf');

?>

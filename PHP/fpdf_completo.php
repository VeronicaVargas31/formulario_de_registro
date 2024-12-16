<?php
require 'datos_completos.php';
require('../fpdf186/fpdf.php');

$pdf = new FPDF('L', 'mm', 'A3');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);


$pdf->Cell(0, 20, 'Datos de Todos los Usuarios', 0, 1, 'C');
$pdf->Ln(10);


$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(226, 167, 240);
$pdf->SetTextColor(0, 0, 0);


$widths = [15, 50, 30, 45, 25, 45, 40, 40, 50, 40];


$columns = ['ID','Nombre Completo','Genero','Fecha de Nacimiento','Pais','Ciudad','Ocupacion','Direccion','Email','Phone'];


foreach ($columns as $index => $columns) {
    $pdf->Cell($widths[$index], 18, $columns, 1, 0, 'C', true);
}
$pdf->Ln();

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell($widths[0], 15, $row['formulario_de_registro_id'], 1, 0, 'C');
    $pdf->Cell($widths[1], 15, $row['nombre_completo'], 1, 0, 'C');
    $pdf->Cell($widths[2], 15, $row['genero'], 1, 0, 'C');
    $pdf->Cell($widths[3], 15, $row['fecha_nacimiento'], 1, 0, 'C');
    $pdf->Cell($widths[4], 15, $row['pais'], 1, 0, 'C');
    $pdf->Cell($widths[5], 15, $row['ciudad'], 1, 0, 'C');
    $pdf->Cell($widths[6], 15, $row['ocupacion'], 1, 0, 'C');
    $pdf->Cell($widths[7], 15, $row['direccion'], 1, 0, 'C');
    $pdf->Cell($widths[8], 15, $row['email'], 1, 0, 'C');
    $pdf->Cell($widths[9], 15, $row['phone'], 1, 1, 'C');
}



$pdf->Output('I', 'Informacion_Usuarios.pdf');
?>
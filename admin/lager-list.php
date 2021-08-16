<?php
require_once '../config/config.php';
use App\Controllers\PDF;

if (session('userId') === null)
    redirect('admin/login');

$from = request()->from;
$to = request()->to;

if (!strtotime($from) || !strtotime($to)) {
    session('error', 'From and to must be valid date!');
    redirect('admin/lager');
}

if (strtotime($from) > strtotime($to)) {
    session('error', 'From must be less then to!');
    redirect('admin/lager');
}

$pdf = new PDF('P','mm', 'A4');
$width = $pdf->getPageSize()[0] - 20;
$pdf->AddPage();
$pdf->SetTitle('Zbirna faktura');
$pdf->SetFont('Arial','',10);
$pdf->Cell($width / 2,10, 'FIRMA' );
$pdf->Ln();
$pdf->Cell($width / 2,5, 'ULICA I BROJ');
$pdf->Ln();
$pdf->twoCellsInRow('MJESTO', 'Ziro racun', $width);
$pdf->twoCellsInRow('Phone:', 'Ziro racun', $width);

$pdf->Output('', '', true);
<?php
require_once '../config/config.php';

use App\Controllers\PDF;
use App\Models\Calculation;
use App\Models\CalculationDetail;

if (session('userId') === null)
    redirect('admin/login');

$from = request()->from;
$to = request()->to;
$id = request()->company;

if (!strtotime($from) || !strtotime($to)) {
    session('error', 'From and to must be valid date!');
    redirect('admin/lager');
}

if (strtotime($from) > strtotime($to)) {
    session('error', 'From must be less then to!');
    redirect('admin/lager');
}

$calculation = Calculation::find($id);
$calculationDetails = CalculationDetail::where('calculation_id', $id)
    ->whereBetween('created_at', [$from, $to])
    ->with('saleDetails')
    ->get();


$pdf = new PDF('P', 'mm', 'A4');
$width = $pdf->getPageSize()[0] - 20;
$pdf->AddPage();
$pdf->SetTitle('LAGER LISTA');
$pdf->SetFont('Arial', '', 20);
$pdf->Cell($width, 10, 'LAGER LISTA', 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 15);
$pdf->Cell($width, 5, 'U periodu od: ' . date('d.m.y', strtotime($from)) . ' do: ' . date('d.m.y', strtotime($to)), 0, 0, 'C');
$pdf->Ln();
$pdf->Cell($width, 5, 'Za objekat: ' . $calculation->name, 0, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$headers = [
    ['name' => 'Sifra',         'width' => 30, 'border' => 'B'],
    ['name' => 'Naziv artikla', 'width' => 50, 'border' => 'B'],
    ['name' => 'JM',            'width' => 20, 'border' => 'B'],
    ['name' => 'Cijena',        'width' => 25, 'border' => 'B'],
    ['name' => 'Kolicina',      'width' => 25, 'border' => 'B'],
    ['name' => 'Vrijednost',    'width' => 35, 'border' => 'B'],
];
$pdf->tableRow($headers);

foreach ($calculationDetails as $key => $value) {
    if ($value->quantity > $value->saleDetails->quantity) {

        $quantity = $value->quantity - $value->saleDetails->quantity;
        $rows = [
            ['name' => $value->code,              'width' => $headers[0]['width'], 'border' => 'B'],
            ['name' => $value->article_name,      'width' => $headers[1]['width'], 'border' => 'B'],
            ['name' => $value->unit_of_measure,   'width' => $headers[2]['width'], 'border' => 'B'],
            ['name' => $value->price,             'width' => $headers[3]['width'], 'border' => 'B'],
            ['name' => $quantity,                 'width' => $headers[4]['width'], 'border' => 'B'],
            ['name' => $quantity * $value->price, 'width' => $headers[5]['width'], 'border' => 'B'],
        ];

        $pdf->tableRow($rows);
    }
}

$pdf->Output('', '', true);

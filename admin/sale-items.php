<?php
require_once '../config/config.php';
use App\Controllers\PDF;
use App\Models\Sale;

if (!session('userId'))
    redirect('admin/login');
$id = strip_tags(request()->id);
if (!isset($id) || empty($id)) {
    redirect('admin/index');
}
$sale = Sale::with('saleDetails')->where('id', $id)->first();

if (empty($sale)) {
    redirect('admin/index');
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

$pdf->Cell($width / 2,5, 'Fax:');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell($width,5, "Identifikacioni broj JIB: $sale->customer_jib Maticni broj: PIB: $sale->customer_pib $sale->web_address e‑mail: $sale->email", 'B', 0, 'C');
$pdf->Ln();
$pdf->Ln();
$pdf->twoCellsWithDecoration($sale->customer, "FAKTURA / OTPREMNICA: {$sale->invoice}", $width, ['', 0, 'C'], []);

$pdf->threeCells('', 'Datum:', $sale->date, $width / 1.8, $width / 7);
$pdf->threeCells('', 'DPO:', $sale->dpo, $width / 1.8, $width / 7);
$pdf->threeCells('', 'Valuta:', $sale->currency, $width / 1.8, $width / 7);
$pdf->threeCells("JIB: $sale->customer_jib", 'Datum isporuke:', date('d.m.Y.', strtotime($sale->delivery_date)), $width / 1.8, $width / 7, ['', 0, 'C']);
$pdf->threeCells("PIB: $sale->customer_pib", 'Mjesto isporuke:', $sale->delivery_place, $width / 1.8, $width / 7, ['', 0, 'C']);
$pdf->Cell($width, 2, '', 'B');
$pdf->Ln();
$headers = [
    ['name' => 'Sifra',         'width' => 15, 'border' => 'B'],
    ['name' => 'Naziv artikla', 'width' => 40, 'border' => 'B'],
    ['name' => 'JM',            'width' => 10, 'border' => 'B'],
    ['name' => 'Kolicina',      'width' => 19, 'border' => 'B'],
    ['name' => 'Cijena',        'width' => 15, 'border' => 'B'],
    ['name' => 'Akciza',        'width' => 15, 'border' => 'B'],
    ['name' => 'Rabat %',       'width' => 19, 'border' => 'B'],
    ['name' => 'Vrijednost',    'width' => 21, 'border' => 'B'],
    ['name' => 'PDV',           'width' => 17, 'border' => 'B'],
    ['name' => 'Ukupno',        'width' => 19, 'border' => 'B'],
];
$pdf->tableRow($headers);
foreach ($sale->saleDetails as $key => $child)
{
    $children = [
        ['name' => $child->code,            'width' => 15, 'border' => 'B'],
        ['name' => $child->article_name,    'width' => 40, 'border' => 'B'],
        ['name' => $child->unit_of_measure, 'width' => 10, 'border' => 'B'],
        ['name' => $child->quantity,        'width' => 19, 'border' => 'B'],
        ['name' => $child->price,           'width' => 15, 'border' => 'B'],
        ['name' => $child->excise,          'width' => 15, 'border' => 'B'],
        ['name' => $child->discount ,       'width' => 19, 'border' => 'B'],
        ['name' => $child->value,           'width' => 21, 'border' => 'B'],
        ['name' => $child->pdv,             'width' => 17, 'border' => 'B'],
        ['name' => $child->total,           'width' => 19, 'border' => 'B']
    ];
    $pdf->tableRow($children);
}
$pdf->Output('', '', true);
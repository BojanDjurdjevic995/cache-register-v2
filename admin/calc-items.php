<?php
require_once '../config/config.php';
use App\Controllers\PDF;
use App\Models\Calculation;

if (!session('userId'))
    redirect('admin/login');
$id = strip_tags(request()->id);
if (!isset($id) || empty($id)) redirect('admin/index');
$calc = Calculation::find($id);
if (empty($calc)) redirect('admin/index');

$calc->load('children');
$width = 400;
$pdf = new PDF('L','mm', 'A3');
$pdf->AddPage();
$pdf->SetTitle('Kalkulacija');
$pdf->SetFont('Arial','',10);
$pdf->Cell($width - 20,10, 'FIRMA. - Kalkulacija', 'B' );
$pdf->Cell(20,10, date('d.m.Y'), 'B');
$pdf->Ln();
$pdf->Cell($width,10, 'VELEPRODAJNA KALKULACIJA: 1 / 274', 0.0, 'C', 'C');
$pdf->Ln();
$arr = [
    [
        ['name' => 'Naziv', 'width' => 20, 'border' => 0],
        ['name' => $calc->name, 'width' => 140, 'border' => 0],
        ['name' => 'Fakturna vrijednost:', 'width' => 60, 'border' => 0],
        ['name' => $calc->invoice_value, 'width' => 60, 'border' => 0],
        ['name' => 'Nabavna vrijednost:', 'width' => 60, 'border' => 0],
        ['name' => $calc->purchase_value, 'width' => 60, 'border' => 0],
    ],
    [
        ['name' => 'Objekat', 'width' => 20, 'border' => 0],
        ['name' => $calc->object, 'width' => 140, 'border' => 0],
        ['name' => 'Rabat:', 'width' => 60, 'border' => 0],
        ['name' => $calc->discount, 'width' => 60, 'border' => 0],
        ['name' => 'Osnovica za PDV:', 'width' => 60, 'border' => 0],
        ['name' => $calc->basis_for_pdv, 'width' => 60, 'border' => 0],
    ],
    [
        ['name' => 'Datum', 'width' => 20, 'border' => 0],
        ['name' => $calc->date, 'width' => 140, 'border' => 0],
        ['name' => 'NF vrijednost:', 'width' => 60, 'border' => 0],
        ['name' => $calc->nf_value, 'width' => 60, 'border' => 0],
        ['name' => 'Ulazni PDV:', 'width' => 60, 'border' => 0],
        ['name' => $calc->input_pdv, 'width' => 60, 'border' => 0],
    ],
    [
        ['name' => 'Dokument', 'width' => 20, 'border' => 0],
        ['name' => $calc->document, 'width' => 140, 'border' => 0],
        ['name' => 'Taksa:', 'width' => 60, 'border' => 0],
        ['name' => $calc->tax, 'width' => 60, 'border' => 0],
        ['name' => 'Razlika u cijeni:', 'width' => 60, 'border' => 0],
        ['name' => $calc->price_difference, 'width' => 60, 'border' => 0],
    ],
    [
        ['name' => 'Dobavljač', 'width' => 100, 'border' => 'LTR'],
        ['name' => '', 'width' => 60, 'border' => 0],
        ['name' => 'Akciza:', 'width' => 60, 'border' => 0],
        ['name' => $calc->excise, 'width' => 60, 'border' => 0],
        ['name' => 'Ukalkulisani PDV:', 'width' => 60, 'border' => 0],
        ['name' => $calc->calculated_pdv, 'width' => 60, 'border' => 0],
    ],
    [
        ['name' => '', 'width' => 100, 'border' => 'LR'],
        ['name' => '', 'width' => 60, 'border' => 0],
        ['name' => 'Carina:', 'width' => 60, 'border' => 0],
        ['name' => $calc->customs, 'width' => 60, 'border' => 0],
        ['name' => 'Prodajna vrijednost:', 'width' => 60, 'border' => 0],
        ['name' => $calc->sales_value, 'width' => 60, 'border' => 0],
    ],
    [
        ['name' => 'Mjesto', 'width' => 100, 'border' => 'LBR'],
        ['name' => '', 'width' => 60, 'border' => 0],
        ['name' => 'Ostali oporezivi troš.:', 'width' => 60, 'border' => 0],
        ['name' => $calc->other_taxable_expenses, 'width' => 60, 'border' => 0],
        ['name' => '', 'width' => 60, 'border' => 0],
        ['name' => '', 'width' => 60, 'border' => 0],
    ],
    [
        ['name' => '', 'width' => 20, 'border' => 0],
        ['name' => '', 'width' => 140, 'border' => 0],
        ['name' => 'Neoporezivi troškovi:', 'width' => 60, 'border' => 0],
        ['name' => $calc->non_taxable_expenses, 'width' => 60, 'border' => 0],
        ['name' => '', 'width' => 60, 'border' => 0],
        ['name' => '', 'width' => 60, 'border' => 0],
    ],
];
$pdf->tableTreeRows($arr);
$pdf->Cell($width,0, '', 1.0, 'C', 'C');
$pdf->Ln();
$pdf->Cell($width,10, 'Stavke robe:', 'B' );
$pdf->Ln();
$headers = [
    ['name' => 'Rbr',           'width' => 10, 'border' => 'B'],
    ['name' => 'Šifra',         'width' => 20, 'border' => 'B'],
    ['name' => 'Naziv artikla', 'width' => 30, 'border' => 'B'],
    ['name' => 'Nab. cijena',   'width' => 25, 'border' => 'B'],
    ['name' => 'JM',            'width' => 10, 'border' => 'B'],
    ['name' => 'Nab. vrijed.',  'width' => 30, 'border' => 'B'],
    ['name' => 'Kol.',          'width' => 15, 'border' => 'B'],
    ['name' => 'Ulazni PDV',    'width' => 25, 'border' => 'B'],
    ['name' => 'Fakt. cijena',  'width' => 25, 'border' => 'B'],
    ['name' => 'RUC %',         'width' => 15, 'border' => 'B'],
    ['name' => 'Rabat %',       'width' => 20, 'border' => 'B'],
    ['name' => 'Iznos rabata',  'width' => 25, 'border' => 'B'],
    ['name' => 'RUC',           'width' => 15, 'border' => 'B'],
    ['name' => 'NF Vrijednost', 'width' => 30, 'border' => 'B'],
    ['name' => 'Ukalk. PDV',    'width' => 30, 'border' => 'B'],
    ['name' => 'TAC',           'width' => 15, 'border' => 'B'],
    ['name' => 'Vrijednost',    'width' => 25, 'border' => 'B'],
    ['name' => 'ZT',            'width' => 15, 'border' => 'B'],
    ['name' => 'Cijena',        'width' => 20, 'border' => 'B'],
];
$pdf->tableRow($headers);
foreach ($calc->children as $key => $child)
{
    $childrens = [
        ['name' => ++$key,                  'width' => 10, 'border' => 'B'],
        ['name' => $child->code,            'width' => 20, 'border' => 'B'],
        ['name' => $child->article_name,    'width' => 30, 'border' => 'B'],
        ['name' => $child->purchase_price,  'width' => 25, 'border' => 'B'],
        ['name' => $child->unit_of_measure, 'width' => 15, 'border' => 'B'],
        ['name' => $child->purchase_value,  'width' => 25, 'border' => 'B'],
        ['name' => $child->quantity ,       'width' => 20, 'border' => 'B'],
        ['name' => $child->input_pdv,       'width' => 25, 'border' => 'B'],
        ['name' => $child->price_invoice,   'width' => 25, 'border' => 'B'],
        ['name' => $child->ruc_perc,        'width' => 15, 'border' => 'B'],
        ['name' => $child->discount,        'width' => 20, 'border' => 'B'],
        ['name' => $child->discount_value,  'width' => 23, 'border' => 'B'],
        ['name' => $child->ruc,             'width' => 20, 'border' => 'B'],
        ['name' => $child->nf_value,        'width' => 30, 'border' => 'B'],
        ['name' => $child->calculated_pdv,  'width' => 25, 'border' => 'B'],
        ['name' => $child->tac,             'width' => 20, 'border' => 'B'],
        ['name' => $child->value,           'width' => 19, 'border' => 'B'],
        ['name' => $child->zt,              'width' => 15, 'border' => 'B'],
        ['name' => $child->price,           'width' => 18, 'border' => 'B'],
    ];
    $pdf->tableRow($childrens);
}
$pdf->Cell($width,40, '', 0.0, 'C', 'C');
$pdf->Ln();
$recieved = [
    ['name' => '', 'width' => 65, 'border' => 0],
    ['name' => 'PRIMIO', 'width' => 50, 'border' => 0],
    ['name' => '', 'width' => 50, 'border' => 0],
    ['name' => 'KALKULISAO', 'width' => 50, 'border' => 0]
];
$pdf->tableRow($recieved);
$recieved = [
    ['name' => '', 'width' => 50, 'border' => 0],
    ['name' => '', 'width' => 50, 'border' => 'B'],
    ['name' => '', 'width' => 50, 'border' => 0],
    ['name' => '', 'width' => 50, 'border' => 'B']
];
$pdf->tableRow($recieved);
$pdf->Output();
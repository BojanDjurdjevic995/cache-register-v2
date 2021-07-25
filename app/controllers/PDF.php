<?php


namespace App\Controllers;

use \FPDF;

class PDF extends FPDF
{
    function tableTreeRows($data)
    {
        foreach($data as $row)
        {
            foreach ($row as $item)
                $this->Cell($item['width'],6, $item['name'], $item['border']);
            $this->Ln();
        }

    }

    function tableRow($data)
    {
        foreach($data as $row)
        {
            $this->Cell($row['width'],6, $row['name'], $row['border']);
        }
        $this->Ln();
    }

    function getPageSize() {
        return $this->CurPageSize;
    }

    function twoCellsInRow($textA, $textB, $width, $border = '', $align = '') {
        $this->Cell($width / 2, 5, $textA, $border, 0, $align);
        $this->Cell($width / 2, 5, $textB, $border, 0, $align);
        $this->Ln();
    }

    function twoCellsWithDecoration($textA, $textB, $width, $decorationA, $decorationB) {
        $this->Cell($width / 1.8, 5, $textA, $decorationA[0] ?? '', $decorationA[1] ?? 0, $decorationA[2] ?? '');
        $this->Cell($width / 1.8, 5, $textB, $decorationB[0] ?? '', $decorationB[1] ?? 0, $decorationB[2] ?? '');
        $this->Ln();
    }

    function threeCells($textA, $textB, $textC, $widthA, $widthB, $decorationA = [], $decorationB = [], $decorationC = []) {
        $this->Cell($widthA, 5, $textA, $decorationA[0] ?? '', $decorationA[1] ?? 0, $decorationA[2] ?? '');
        $this->Cell($widthB, 5, $textB, $decorationB[0] ?? '', $decorationB[1] ?? 0, $decorationB[2] ?? '');
        $this->Cell($widthB, 5, $textC, $decorationC[0] ?? '', $decorationC[1] ?? 0, $decorationC[2] ?? '');
        $this->Ln();
    }
}
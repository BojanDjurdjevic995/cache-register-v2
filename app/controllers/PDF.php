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
}
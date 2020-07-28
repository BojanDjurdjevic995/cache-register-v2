<?php
require_once '../config/config.php';
if (request()->isAjax())
{
    $items = [
        ['name' => 'Šifra', 'type' => 'text', 'inputName' => 'code'], ['name' => 'Naziv artikla', 'type' => 'text', 'inputName' => 'article_name'],
        ['name' => 'Nab. cijena', 'type' => 'number', 'inputName' => 'purchase_price'], ['name' => 'JM', 'type' => 'text', 'inputName' => 'unit_of_measure'],
        ['name' => 'Nab. vrijed.', 'type' => 'number', 'inputName' => 'purchase_value'], ['name' => 'Kol.', 'type' => 'number', 'inputName' => 'quantity'],
        ['name' => 'Ulazni PDV', 'type' => 'number', 'inputName' => 'input_pdv'], ['name' => 'Fakt. cijena', 'type' => 'number', 'inputName' => 'price_invoice'],
        ['name' => 'RUC %', 'type' => 'number', 'inputName' => 'ruc_perc'], ['name' => 'Rabat %', 'type' => 'number', 'inputName' => 'discount'],
        ['name' => 'Iznos rabata', 'type' => 'number', 'inputName' => 'discount_value'], ['name' => 'RUC', 'type' => 'number', 'inputName' => 'ruc'],
        ['name' => 'NF Vrijednost', 'type' => 'number', 'inputName' => 'nf_value'], ['name' => 'Ukalk. PDV', 'type' => 'number', 'inputName' => 'calculated_pdv'],
        ['name' => 'TAC', 'type' => 'number', 'inputName' => 'tac'], ['name' => 'Vrijednost', 'type' => 'number', 'inputName' => 'value'],
        ['name' => 'ZT', 'type' => 'number', 'inputName' => 'zt'], ['name' => 'Cijena', 'type' => 'number', 'inputName' => 'price'],
    ];

    echo json_encode($items); exit();
}

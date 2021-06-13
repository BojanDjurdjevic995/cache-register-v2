<?php
require_once '../config/config.php';
if (request()->isAjax() && request()->_token == csrf_token())
{
    $mainFields = [
        ['name' => 'Šifra', 'type' => 'text', 'inputName' => 'details_code'], ['name' => 'Naziv artikla', 'type' => 'text', 'inputName' => 'details_article_name'],
        ['name' => 'Nab. cijena', 'type' => 'number', 'inputName' => 'details_purchase_price'], ['name' => 'JM', 'type' => 'text', 'inputName' => 'details_unit_of_measure'],
        ['name' => 'Nab. vrijed.', 'type' => 'number', 'inputName' => 'details_purchase_value'], ['name' => 'Kol.', 'type' => 'number', 'inputName' => 'details_quantity'],
        ['name' => 'Ulazni PDV', 'type' => 'number', 'inputName' => 'details_input_pdv'], ['name' => 'Fakt. cijena', 'type' => 'number', 'inputName' => 'details_price_invoice'],
        ['name' => 'RUC %', 'type' => 'number', 'inputName' => 'details_ruc_perc'], ['name' => 'Rabat %', 'type' => 'number', 'inputName' => 'details_discount'],
        ['name' => 'Iznos rabata', 'type' => 'number', 'inputName' => 'details_discount_value'], ['name' => 'RUC', 'type' => 'number', 'inputName' => 'details_ruc'],
        ['name' => 'NF Vrijednost', 'type' => 'number', 'inputName' => 'details_nf_value'], ['name' => 'Ukalk. PDV', 'type' => 'number', 'inputName' => 'details_calculated_pdv'],
        ['name' => 'TAC', 'type' => 'number', 'inputName' => 'details_tac'], ['name' => 'Vrijednost', 'type' => 'number', 'inputName' => 'details_value'],
        ['name' => 'ZT', 'type' => 'number', 'inputName' => 'details_zt'], ['name' => 'Cijena', 'type' => 'number', 'inputName' => 'details_price'],
    ];
    $return = '<h4 class="numOfAppend" data-num="'.request()->num.'">#'.request()->num.'</h4><div class="row">';
    foreach ($mainFields as $key => $field) {
         $return .= '<div class="form-group">
                <label>'.$field['name'].'</label>
                <input type="'.$field['type'].'" name="'.$field['inputName'].'[]" '.($field['type'] == 'number' ? 'step=".01"' : '').' class="form-control">
            </div>';
    }
    $return .= '</div>';
    echo json_encode($return);
}
<?php
require_once '../config/config.php';
if (request()->isAjax() && request()->_token == csrf_token())
{
    $mainFields = [
        ['name' => 'Šifra', 'type' => 'text', 'inputName' => 'code'],
        ['name' => 'Naziv artikla', 'type' => 'text', 'inputName' => 'article_name'],
        ['name' => 'JM', 'type' => 'text', 'inputName' => 'unit_of_measure'],
        ['name' => 'Količina', 'type' => 'number', 'inputName' => 'quantity'],
        ['name' => 'Cijena', 'type' => 'number', 'inputName' => 'price'],
        ['name' => 'Akciza', 'type' => 'number', 'inputName' => 'excise'],
        ['name' => 'Rabat %', 'type' => 'number', 'inputName' => 'discount'],
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
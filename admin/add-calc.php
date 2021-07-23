<?php
require_once '../config/config.php';
use App\Models\Calculation;
use App\Models\CalculationDetail;
if (!session('userId'))
    redirect('admin/login');
$mainFields = [
    ['name' => 'Naziv', 'type' => 'text', 'inputName' => 'name'], ['name' => 'Objekat', 'type' => 'text', 'inputName' => 'object'],
    ['name' => 'Datum', 'type' => 'date', 'inputName' => 'date'], ['name' => 'Dokument', 'type' => 'text', 'inputName' => 'document'],
    ['name' => 'Fakturna vrijednost', 'type' => 'number', 'inputName' => 'invoice_value'], ['name' => 'Rabat', 'type' => 'number', 'inputName' => 'discount'],
    ['name' => 'NF vrijednost', 'type' => 'number', 'inputName' => 'nf_value'], ['name' => 'Taksa', 'type' => 'number', 'inputName' => 'tax'],
    ['name' => 'Akciza', 'type' => 'number', 'inputName' => 'excise'], ['name' => 'Carina', 'type' => 'number', 'inputName' => 'customs'],
    ['name' => 'Ostali oporezivi troš.', 'type' => 'number', 'inputName' => 'other_taxable_expenses'], ['name' => 'Neoporezivi troškovi', 'type' => 'number', 'inputName' => 'non_taxable_expenses'],
    ['name' => 'Nabavna vrijednost', 'type' => 'number', 'inputName' => 'purchase_value'], ['name' => 'Osnovica za PDV', 'type' => 'number', 'inputName' => 'basis_for_pdv'],
    ['name' => 'Ulazni PDV', 'type' => 'number', 'inputName' => 'input_pdv'], ['name' => 'Razlika u cijeni', 'type' => 'number', 'inputName' => 'price_difference'],
    ['name' => 'Ukalkulisani PDV', 'type' => 'number', 'inputName' => 'calculated_pdv'], ['name' => 'Prodajna vrijednost', 'type' => 'number', 'inputName' => 'sales_value'],
];
$subFields = [
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
if (request()->isMethod('POST'))
{
    $r = request();
    $calc = new Calculation();
    foreach ($mainFields as $value)
        $calc->{$value['inputName']} = strip_tags($r->{$value['inputName']});
    $calc->save();
    $br = count($r->details_code);
    for ($i = 0; $i < $br; $i++)
    {
        $details = new CalculationDetail();
        $details->calculation_id = $calc->id;
        foreach ($subFields as $items)
            $details->{str_replace('details_', '', $items['inputName'])} = $r->{$items['inputName']}[$i];
        $details->save();
    }
    redirect('admin/calc-items');
}

__include('admin-header', ['title' => 'Add Calculation']);
?>
    <form method="post" action="">
        <h3 class="text-center">Calculation</h3>
        <div class="row">
            <?php foreach ($mainFields as $key => $field) { ?>
                <div class="form-group">
                    <label><?= $field['name'] ?></label>
                    <input type="<?= $field['type'] ?>" name="<?= $field['inputName'] ?>" <?= $field['type'] == 'number' ? 'step=".01"' : '' ?> class="form-control">
                </div>
            <?php } ?>
        </div>
        <h3 class="text-center">Details</h3>
        <div id="appednDetails"></div>
        <a class="btn btn-success float-right" style="cursor: pointer" onclick="getDetails('calc')">Add more</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
<?php __include('admin-footer'); ?>
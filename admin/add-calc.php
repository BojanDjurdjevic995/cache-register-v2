<?php
require_once '../config/config.php';
use App\Models\Calculation;
if (!session('userId'))
    redirect('admin/login');
if (request()->isMethod('POST'))
{
    $r = request()->__get();
    $calc = new Calculation();
    foreach ($r as $key => $value)
        $calc->{$key} = strip_tags($value);
    $calc->save();
    redirect('admin/calc-items');
}
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
__include('admin-header', ['title' => 'Add Calculation']);
?>
    <form method="post" action="">
        <div class="row">
            <?php foreach ($mainFields as $key => $field) { ?>
                <div class="form-group">
                    <label><?= $field['name'] ?></label>
                    <input type="<?= $field['type'] ?>" name="<?= $field['inputName'] ?>" <?= $field['type'] == 'number' ? 'step=".01"' : '' ?> class="form-control">
                </div>
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
<?php __include('admin-footer'); ?>
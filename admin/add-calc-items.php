<?php
require_once '../config/config.php';
use App\Models\Calculation;
use App\Models\CalculationDetail;
if (!session('userId'))
    redirect('admin/login');
$id = strip_tags($_GET['id']);
if (!isset($id) || empty($id)) redirect('admin/index');
$calc = Calculation::find($id);
if (request()->isMethod('POST'))
{
    $r = request()->__get();
    $calcItems = new CalculationDetail();
    $calcItems->calculation_id = $calc->id;
    foreach ($r as $key => $value)
        $calcItems->{$key} = strip_tags($value);
    $calcItems->save();
    redirect('admin/calc-items');
}
if (empty($calc)) redirect('admin/index');
__include('admin-header', ['title' => 'Add Calculation Items']);
$mainFields = [
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

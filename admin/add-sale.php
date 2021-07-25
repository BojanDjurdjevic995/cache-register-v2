<?php
require_once '../config/config.php';
use App\Models\Sale;
use App\Models\SaleDetail;

if (session('userId') === null)
    redirect('admin/login');
$mainFields = [
    ['name' => 'KUPCI U MALOPRODAJI', 'type' => 'text', 'inputName' => 'customer'], 
    ['name' => 'PIB', 'type' => 'text', 'inputName' => 'customer_pib'],
    ['name' => 'JIB', 'type' => 'text', 'inputName' => 'customer_jib'], 
    ['name' => 'Web adresa', 'type' => 'text', 'inputName' => 'web_address'],
    ['name' => 'Email', 'type' => 'text', 'inputName' => 'email'],
    ['name' => 'FAKTURA / OTPREMNICA', 'type' => 'text', 'inputName' => 'invoice'],
    ['name' => 'Datum', 'type' => 'date', 'inputName' => 'date'],
    ['name' => 'DPO', 'type' => 'text', 'inputName' => 'dpo'], 
    ['name' => 'Valuta', 'type' => 'text', 'inputName' => 'currency'],
    ['name' => 'Datum isporuke', 'type' => 'date', 'inputName' => 'delivery_date'], 
    ['name' => 'Mjesto isporuke', 'type' => 'text', 'inputName' => 'delivery_place']
];
$subFields = [
    ['name' => 'Šifra', 'type' => 'text', 'inputName' => 'code'],
    ['name' => 'Naziv artikla', 'type' => 'text', 'inputName' => 'article_name'], 
    ['name' => 'JM', 'type' => 'text', 'inputName' => 'unit_of_measure'],
    ['name' => 'Količina', 'type' => 'number', 'inputName' => 'quantity'], 
    ['name' => 'Cijena', 'type' => 'number', 'inputName' => 'price'],
    ['name' => 'Akciza', 'type' => 'number', 'inputName' => 'excise'], 
    ['name' => 'Rabat %', 'type' => 'number', 'inputName' => 'discount'],
];
if (request()->isMethod('POST'))
{
    $r = request();
    $sale = new Sale();
    foreach ($mainFields as $value)
        $sale->{$value['inputName']} = strip_tags($r->{$value['inputName']});
    $sale->save();
    $br = count($r->code);
    for ($i = 0; $i < $br; $i++)
    {
        $details = new SaleDetail();
        $details->sale_id = $sale->id;
        foreach ($subFields as $items)
            $details->{$items['inputName']} = $r->{$items['inputName']}[$i];
        $details->value = $details->price * $details->quantity;
        $details->pdv   = ($details->value * 17) / 100;
        $details->total = $details->price * $details->quantity;
        $details->save();
    }
    redirect('admin/sale');
}

__include('admin-header', ['title' => 'Add Sale']);
?>
    <form method="post" action="">
        <h3 class="text-center">Sale</h3>
        <div class="row">
            <?php foreach ($mainFields as $key => $field) { ?>
                <div class="form-group">
                    <label><?= $field['name'] ?></label>
                    <input type="<?= $field['type'] ?>" name="<?= $field['inputName'] ?>" <?= $field['type'] == 'number' ? 'step=".01"' : '' ?> class="form-control">
                </div>
            <?php } ?>
        </div>
        <h3 class="text-center">Sale Details</h3>
        <div id="appednDetails"></div>
        <a class="btn btn-success float-right" style="cursor: pointer" onclick="getDetails('sale')">Add more</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
<?php __include('admin-footer'); ?>
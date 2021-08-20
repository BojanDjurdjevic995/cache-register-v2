<?php
require_once '../config/config.php';

use App\Models\Calculation;

if (session('userId') === null)
    redirect('admin/login');

$calculations = Calculation::select('id', 'name')->get();
__include('admin-header', ['title' => 'Lager']);

?>
<div class="alert alert-success">Lager lista</div>
<form action="./lager-list.php">
    <select class="form-control" name="company" id="" style="width: 30%;">
        <option value="">Za objekat</option>
        <?php foreach ($calculations as $calculation) { ?>
            <option value="<?= $calculation->id ?>"><?= $calculation->name ?></option>
        <?php } ?>
    </select>
    <label>Izaberite period</label>
    <div class="input-group mb-3">
        <div class="form-group mr-2">
            <label>Od</label>
            <input type="date" name="from" class="form-control">
        </div>
        <div class="form-group">
            <label>Do</label>
            <input type="date" name="to" class="form-control">
        </div>
    </div>
    <button class="btn btn-primary">Prikaži</button>
</form>
<?php __include('admin-footer'); ?>
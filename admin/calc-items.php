<?php
require_once '../config/config.php';
use App\Models\Calculation;
use App\Models\CalculationDetail;
if (!session('userId'))
    redirect('admin/login');
$id = strip_tags(request()->id);
if (!isset($id) || empty($id)) redirect('admin/index');
$calc = Calculation::find($id);
if (empty($calc)) redirect('admin/index');
$calcDetail = CalculationDetail::where('calculation_id', $calc->id)->get();
__include('admin-header', ['title' => 'Calculation items']);
?>
    <div class="card">
        <h4><?= $calc->name ?></h4>
        <h4><?= $calc->object ?></h4>
        <h4><?= $calc->document ?></h4>
    </div>
    <h4>Stavke kalkulacije:</h4>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Rbr</th>
                <th>Šifra</th>
                <th>Naziv artikla</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($calcDetail as $key => $item) { ?>
                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $item->code ?></td>
                    <td><?= $item->article_name ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php __include('admin-footer'); ?>
<?php
require_once '../config/config.php';
use App\Models\Calculation;
if (request()->isAjax() && (request()->_token === csrf_token()))
{
    $sql = '';
    $columns = array(
        0 => 'id',
        1 => 'name',
        2 => 'object',
        3 => 'date',
    );
    $limit = request()->length;
    $start = request()->start;
    $order = $columns[request()->order[0]->column] ;
    $dir   = request()->order[0]->dir;
    $calculations = Calculation::orderBy($order, $dir);

    if (!empty(request()->search->value))
    {
        $value = strip_tags(request()->search->value);
        $calculations->orWhere('name', 'LIKE', '%'.$value.'%')->orWhere('object', 'LIKE', '%'.$value.'%')->orWHere('date', '%'.$value.'%')->orWhere('document', 'LIKE', '%'.$value.'%');
    }

    $totalData = $calculations;
    $totalData = $totalData->count();
    $totalFiltered  = $totalData;

    $curentPage = $start == 0 ? 1 : ($start/$limit) + 1;
    $br = ($curentPage - 1) * $limit + 1;
    $calculations->limit($limit)->offset($start);

    $calculations = $calculations->get();

    $data = array();
    if(!empty($calculations))
        foreach ($calculations as $item)
        {
            $nestedData['id']       = $br++;
            $nestedData['name']     = $item->name;
            $nestedData['object']   = $item->object;
            $nestedData['date']     = $item->date;
            $nestedData['document'] = $item->document;
            $nestedData['items']    = '<a class="btn btn-primary buttonPadding" href="'.asset('admin/calc-items.php?id=' . $item->id).'">Items</a>
                                        <a class="btn btn-primary buttonPadding" href="'.asset('admin/add-calc-items.php?id=' . $item->id).'">Add</a>';

            $data[] = $nestedData;
        }

    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );
    echo json_encode($json_data);
}
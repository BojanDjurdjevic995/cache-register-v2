<?php
require_once '../config/config.php';
use App\Models\Sale;
if (request()->isAjax() && (request()->_token === csrf_token()))
{
    $sql = '';
    $columns = array(
        0 => 'id',
        1 => 'customer',
        2 => 'customer_pib',
        3 => 'customer_jib',
        4 => 'invoice',
        5 => 'delivery_place'
    );
    $limit = request()->length;
    $start = request()->start;
    $order = $columns[request()->order[0]->column] ;
    $dir   = request()->order[0]->dir;
    $sale = Sale::orderBy($order, $dir);

    if (!empty(request()->search->value))
    {
        $value = strip_tags(request()->search->value);
        $sale->orWhere('customer', 'LIKE', '%' . $value . '%')
        ->orWhere('customer_pib', 'LIKE', '%' . $value . '%')
        ->orWHere('customer_jib', '%' . $value . '%')
        ->orWhere('invoice', 'LIKE', '%' . $value . '%')
        ->orWhere('delivery_place', 'LIKE', '%' . $value . '%');
    }

    $totalData = $sale;
    $totalData = $totalData->count();
    $totalFiltered  = $totalData;

    $curentPage = $start == 0 ? 1 : ($start/$limit) + 1;
    $br = ($curentPage - 1) * $limit + 1;
    $sale->limit($limit)->offset($start);

    $sale = $sale->get();

    $data = array();
    if(!empty($sale))
        foreach ($sale as $item)
        {
            $nestedData['id']             = $br++;
            $nestedData['customer']       = $item->customer;
            $nestedData['customer_pib']   = $item->customer_pib;
            $nestedData['customer_jib']   = $item->customer_jib;
            $nestedData['invoice']        = $item->invoice;
            $nestedData['delivery_place'] = $item->delivery_place;

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
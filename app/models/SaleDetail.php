<?php


namespace App\Models;

use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use ConnectionHelper;
    protected $table = 'sale_details';
    protected $keyType = 'uuid';
}
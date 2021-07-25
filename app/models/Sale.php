<?php


namespace App\Models;

use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Model;

class Sale  extends Model
{
    use ConnectionHelper;
    protected $table = 'sales';
    protected $keyType = 'uuid';

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'id');
    }
}
<?php


namespace App\Models;

use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Model;

class CalculationDetail extends Model
{
    use ConnectionHelper;
    protected $table = 'calculation_details';
    protected $keyType = 'uuid';

    public function saleDetails()
    {
        return $this->hasOne(SaleDetail::class, 'code', 'code');
    }
}

<?php


namespace App\Models;

use App\Models\CalculationDetail;
use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use ConnectionHelper;
    protected $table = 'calculation';
    protected $keyType = 'uuid';

    public function children()
    {
        return $this->hasMany(CalculationDetail::class, 'calculation_id', 'id');
    }
}
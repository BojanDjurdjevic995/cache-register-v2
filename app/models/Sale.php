<?php


namespace App\Models;

use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Model;

class Sale  extends Model
{
    use ConnectionHelper;
    protected $table = 'sales';
}
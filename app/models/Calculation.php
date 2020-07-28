<?php


namespace App\Models;

use App\Traits\ConnectionHelper;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use ConnectionHelper;
    protected $table = 'calculation';
}
<?php
require_once '../config/config.php';
use App\Models\DB;

$conn = new DB();

$calculation = require_once('./calculation.migration.php');
startMigration($calculation);
$ids = $conn->select('SELECT id FROM calculation');

$sales = require_once('./sales.migration.php');
startMigration($sales);
$saleID = $conn->select('SELECT id FROM sales')[0]['id'];

$migrations_files = ['users', 'sales-details', 'calculation-details'];

foreach($migrations_files as $migration) {
  $file = require_once('./' . $migration . '.migration.php');
  startMigration($file);
}


function startMigration($migrationFile) {
  $conn = new DB();
  $conn->insert($migrationFile['drop']);
  $conn->insert($migrationFile['create']);
  $conn->insert($migrationFile['insert']);
}
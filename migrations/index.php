<?php
require_once '../config/config.php';
use App\Models\DB;

$conn = new DB();

$calculation = require_once('./calculation.migration.php');
startMigration($calculation);
$ids = $conn->select('SELECT id FROM calculation');

$migrations_files = ['users', 'sales', 'sale-details', 'calculation-details'];
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
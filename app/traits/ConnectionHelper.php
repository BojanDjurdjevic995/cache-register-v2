<?php
namespace App\Traits;

use PDO;
use Illuminate\Database\PostgresConnection;

trait ConnectionHelper
{
    public function getConnection($connection = 'postgres', $pdoReturn = false)
    {
        
        $connection = isset($this->conn) ? $this->conn : $connection;
        $DB      = include ROOT_PATH . 'config/database.php';
        $DB      = $DB['connections'][$connection];
        $db      = $DB['database'];
        $user    = $DB['username'];
        $pass    = $DB['password'];
        $charset = $DB['charset'];
       
        $pdo = new PDO('pgsql:host=localhost;port=5439;dbname='.$db, $user, $pass);
        $conn = new PostgresConnection($pdo, env('DB_DATABASE'), '', $DB);
        if ($pdoReturn)
            return $pdo;
        return $conn;
    }

    public static function getColumnName()
    {
        $it = (new static());
        $sql = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_NAME = N\''.$it->table.'\' AND COLUMN_NAME <> \'created_at\' AND COLUMN_NAME <> \'updated_at\' AND COLUMN_NAME NOT LIKE \'%id%\'';

        $data = $it->getConnection('mysql', true)->prepare($sql);
        $data->execute();
        $data = $data->fetchAll(\PDO::FETCH_OBJ);
        $returned = [];
        foreach ($data as $item)
            $returned[] = $it->table . '.' . $item->COLUMN_NAME . ' AS ' . $it->table . '_' . $item->COLUMN_NAME ;
        return $returned;
    }
}
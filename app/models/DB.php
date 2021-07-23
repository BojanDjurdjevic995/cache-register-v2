<?php


namespace App\Models;

use PDO;
use App\Traits\ConnectionHelper;

class DB
{
    use ConnectionHelper;

    public function insert($sql) {
        $pdo = $this->getConnection('postgres', true);
        $statement = $pdo->prepare($sql);

        $statement->execute();
    }

    public function select($sql) {
        $pdo = $this->getConnection('postgres', true);
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
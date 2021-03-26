<?php


namespace App;

use Exception;
use PDO;

class DB
{
    private PDO $connection;


    public function __construct(Connection $connection)
    {
        $this->connection = $connection->connect();
    }

    /** Return count of rows in db TABLE
     * @return int
     * @throws Exception
     */
    public function getTableRowsCount(string $tableName): int {
        $stmn = $this->connection->query('SELECT COUNT(*) AS num FROM '.$tableName);
        $row = $stmn->fetch( PDO::FETCH_ASSOC );
        return $row['num'];
    }

    /** Return rows from db TABLE
     * @param string $tableName
     * @return array
     */
    public function getTableRows(string $tableName): array {
        $stmn = $this->connection->query('SELECT * FROM '.$tableName);
        return $stmn->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public function getTableRowById(string $tableName, int $id): array {
        $stmn = $this->connection->query('SELECT * FROM '.$tableName.'WHERE id='.$id);
        return $stmn->fetch(PDO::FETCH_ASSOC);
    }*/

}
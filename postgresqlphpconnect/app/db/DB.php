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

    /** Return row from db TABLE by ID key
     * @param string $tableName
     * @param int $id
     * @return array
     */
    public function getTableRowById(string $tableName, int $id): array {
        $stmn = $this->connection->query('SELECT * FROM '.$tableName.' WHERE id = '.$id);
        return $stmn->fetch(PDO::FETCH_ASSOC);
    }

    /** Return rows from db TABLE by parameters (offset, limit. order by)
     * @param string $tableName
     * @param int $limit
     * @param int $offset
     * @param string $orderByColumn
     * @return array
     */
    public function getTableRowsByParameters(string $tableName, int $limit, int $offset, string $orderByColumn): array {
        $stmn = $this->connection->query('SELECT * FROM '.$tableName.' ORDER BY ' .$orderByColumn. ' DESC'.' LIMIT '.$limit.' OFFSET '.$offset);
        return $stmn->fetchAll(PDO::FETCH_ASSOC);
    }

}
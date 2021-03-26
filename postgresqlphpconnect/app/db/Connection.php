<?php
namespace  App;
use Exception;
use PDO;

/**
 * Represent the Connection to db (Singleton)
 */

class Connection {
    /**
     *Connection
     *@var Connection
     */

    private static $connection;

    /**
     * Connect to the database and return an instance of \PDO object
     * @return PDO
     * @throws Exception
     */

    public function connect(): PDO
    {
        $params = parse_ini_file('app/config/database.ini');
        if($params === false) {
            throw new Exception("Error on parse database.ini file!");
        }
        $conStr = sprintf("%s:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $params['type'],
            $params['host'],
            $params['port'],
            $params['database'],
            $params['user'],
            $params['password']);

        $pdo = new PDO($conStr);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    /**
     * return an instance of the Connection object
     * @return Connection
     */
    public static function getConnection(): Connection
    {
        if (null === static::$connection) {
            static::$connection = new static();
        }
        return static::$connection;
    }

    private function __construct() {}

    private function __clone() {}

    public function __wakeup() {throw new Exception("Cannot unserialize a singleton.");}
}
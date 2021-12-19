<?php

namespace Service;

use Dotenv\Dotenv;
use Exception;
use PDO;
use PDOException;

class DatabaseService
{
    private PDO $pdo;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        try {
            self::connectToDatabase();
        } catch (Exception $exception) {
            echo $exception;
        }
    }

    /**
     * @throws Exception
     */
    private function connectToDatabase()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
        $connectionString = 'pgsql:host=' . $_ENV['DB_HOST'] .
            ";port=" . $_ENV['DB_PORT'] .
            ";dbname=" . $_ENV['DB_NAME'] .
            ";user=" . $_ENV['DB_USER'] .
            ";password=" . $_ENV['DB_PASSWORD'];
        try {
            $this->pdo = new PDO($connectionString);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function execSql(string $sql, array $params = []): array
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll();
    }
}

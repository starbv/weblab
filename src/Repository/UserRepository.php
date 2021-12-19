<?php


namespace Repository;

use Service\DatabaseService;

class UserRepository
{
    private DatabaseService $db;

    public function __construct()
    {
        $this->db = new DatabaseService();
    }

    public function getUserFirstName(int $userId): ?string
    {
        $sql = "select first_name from account where id = :user_id";
        $result = $this->db->execSql($sql, ['user_id' => $userId]);
        if (count($result[0]) == 0) {
            return null;
        }
        return $result[0]['first_name'];
    }
}

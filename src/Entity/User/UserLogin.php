<?php


namespace Entity\User;

use Service\DatabaseService;

class UserLogin
{
    private string $email;
    private string $password;

    public function __construct(array $data)
    {
        self::setEmail($data['email']);
        self::setPassword($data['password']);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function login(): int
    {
        $sql = "select id, password from account where email = :email";
        $db = new DatabaseService();
        $result = $db->execSql($sql, ['email' => self::getEmail()]);
        if (count($result) == 0) {
            return -1;
        }
        $userId = $result[0]['id'];
        $dbPassword = $result[0]['password'];

        if (password_verify(self::getPassword(), $dbPassword)) {
            return $userId;
        }

        return -1;
    }

}

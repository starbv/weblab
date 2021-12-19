<?php


namespace Entity\User;

use Service\DatabaseService;

class UserCreate
{
    private string $lastName;
    private string $firstName;
    private string $patronymic;
    private string $email;
    private string $phone;
    private string $password;

    public function __construct(array $data)
    {
        self::setLastName($data['last_name']);
        self::setFirstName($data['first_name']);
        self::setPatronymic($data['patronymic']);
        self::setEmail($data['email']);
        self::setPhone($data['phone']);
        self::setPassword($data['password']);
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getPatronymic(): string
    {
        return $this->patronymic ?? "";
    }

    /**
     * @param string $patronymic
     */
    public function setPatronymic(string $patronymic): void
    {
        $this->patronymic = $patronymic;
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
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
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
        $this->password = (string)password_hash($password, PASSWORD_DEFAULT);
    }

    public function create(): int
    {
        $sql = "";
        if ($this->getPatronymic() === "") {
            $sql = "insert into account (last_name, first_name, email, phone, password) values (:last_name, :first_name, :email, :phone, :password) returning id";
        } else {
            $sql = "insert into account (last_name, first_name, patronymic, email, phone, password) values (:last_name, :first_name, :patronymic, :email, :phone, :password) returning id";
        }
        $db = new DatabaseService();
        $result = $db->execSql($sql, self::getData());
        if (count($result) == 1) {
            return $result[0]['id'];
        }
        return -1;
    }

    private function getData(): array
    {
        $result = [];
        $result['last_name'] = self::getLastName();
        $result['first_name'] = self::getFirstName();
        $result['patronymic'] = self::getPatronymic();
        $result['email'] = self::getEmail();
        $result['phone'] = self::getPhone();
        $result['password'] = self::getPassword();
        return $result;
    }
}

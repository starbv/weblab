<?php


namespace Entity\Score;

use Service\DatabaseService;

class ScoreCreate
{
    private int $value;
    private int $postId;
    private int $accountId;

    public function __construct(array $data)
    {
        self::setValue($data['value']);
        self::setPostId($data['post_id']);
        self::setAccountId($data['account_id']);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function create(): int
    {
        $sql = "insert into score (value, post_id, account_id) values (:value, :post_id, :account_id) returning id";
        $db = new DatabaseService();
        $result = $db->execSql($sql, [
            'value' => self::getValue(),
            'post_id' => self::getPostId(),
            'account_id' => self::getAccountId()
        ]);
        if (count($result) != 0) {
            return $result[0]['id'];
        }
        return -1;
    }
}

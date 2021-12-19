<?php


namespace Entity\Post;

use Service\DatabaseService;

class PostCreate
{
    private string $title;
    private string $description;
    private int $accountId;
    private int $photoId;

    public function __construct(array $data)
    {
        self::setTitle($data['title']);
        self::setDescription($data['description']);
        self::setAccountId($data['account_id']);
        self::setPhotoId($data['photo_id']);
    }

    public function create(): int
    {
        $sql = "insert into post (title, description, account_id, photo_id) values (:title, :description, :account_id, :photo_id) returning id";
        $db = new DatabaseService();
        $result = $db->execSql($sql, ['title' => self::getTitle(),
                'description' => self::getDescription(),
                'account_id' => self::getAccountId(),
                'photo_id' => self::getPhotoId()
        ]);
        if (count($result[0]) != 0) {
            return $result[0]['id'];
        }
        return -1;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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

    /**
     * @return int
     */
    public function getPhotoId(): int
    {
        return $this->photoId;
    }

    /**
     * @param int $photoId
     */
    public function setPhotoId(int $photoId): void
    {
        $this->photoId = $photoId;
    }

}

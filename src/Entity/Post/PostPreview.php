<?php


namespace Entity\Post;

use DateTime;

class PostPreview
{
    private int $id;
    private string $title;
    private string $imageUrl;
    private string $authorName;
    private string $authorImage;
    private string $date;

    public function __construct(array $data)
    {
        self::setId($data['id']);
        self::setTitle($data['title']);
        self::setImageUrl($data['post_image']);
        self::setAuthorName($data['account_name']);
        self::setAuthorImage($data['account_image'] ?? "");
        self::setDate($data['create_date']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * @return string
     */
    public function getAuthorImage(): string
    {
        return $this->authorImage;
    }

    /**
     * @param string $authorImage
     */
    public function setAuthorImage(string $authorImage = ""): void
    {
        $this->authorImage = $authorImage;
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['image_url'] = $this->imageUrl;
        $result['author_name'] = $this->authorName;
        $result['author_image'] = $this->authorImage;
        $result['date'] = self::getDate();
        $result['title'] = $this->title;
        return $result;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s.ue', $this->date);
        return $date->format('d-m-Y');
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
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
}

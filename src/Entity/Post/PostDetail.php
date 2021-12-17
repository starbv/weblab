<?php


namespace Entity\Post;

use DateTime;

class PostDetail
{
    private int $id;
    private string $title;
    private string $description;
    private string $imageUrl;
    private string $createDate;
    private string $authorName;
    private string $authorImage;
    private int $totalCountScores;
    private float $avgScore;

    public function __construct(array $data)
    {
        self::setId($data['id']);
        self::setTitle($data['title']);
        self::setDescription($data['description']);
        self::setCreateDate($data['create_date']);
        self::setAuthorName($data['account_name']);
        self::setAuthorImage($data['account_image'] ?? "");
        self::setTotalCountScores($data['total_count_score']);
        self::setAvgScore($data['avg_score'] ?? 0.0);
        self::setImageUrl($data['post_image']);
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

    /**
     * @return int
     */
    public function getTotalCountScores(): int
    {
        return $this->totalCountScores;
    }

    /**
     * @param int $totalCountScores
     */
    public function setTotalCountScores(int $totalCountScores): void
    {
        $this->totalCountScores = $totalCountScores;
    }

    /**
     * @return float
     */
    public function getAvgScore(): float
    {
        return $this->avgScore;
    }

    /**
     * @param float $avgScore
     */
    public function setAvgScore(float $avgScore): void
    {
        $this->avgScore = $avgScore;
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['description'] = $this->description;
        $result['create_date'] = self::getCreateDate();
        $result['account_name'] = $this->authorName;
        $result['account_image'] = $this->authorImage;
        $result['total_count_score'] = $this->totalCountScores;
        $result['avg_score'] = $this->avgScore;
        $result['image_url'] = $this->imageUrl;
        return $result;
    }

    /**
     * @return string
     */
    public function getCreateDate(): string
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s.ue', $this->createDate);
        return $date->format('d-m-Y');
    }

    /**
     * @param string $createDate
     */
    public function setCreateDate(string $createDate): void
    {
        $this->createDate = $createDate;
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
}

<?php


namespace Entity\Photo;

use Service\DatabaseService;

class PhotoCreate
{
    private string $path;
    private string $name;
    private string $tmpFileName;

    public function __construct(array $data)
    {
        self::setName($data['name']);

        $pathInfo = pathinfo($data['name']);
        $ext = $pathInfo['extension'] ?? "";
        $newPath = 'uploads/' . uniqid() . "." . $ext;

        self::setPath($newPath);
        self::setTmpFileName($data['tmp_name']);
    }

    public function create(): int
    {
        if (!move_uploaded_file(self::getTmpFileName(), self::getPath())) {
            var_dump('pizda');
            die();
            return -1;
        }
        $sql = "insert into photo (path, name) values (:path, :name) returning id";
        $db = new DatabaseService();
        $result = $db->execSql($sql, ['path' => self::getPath(), 'name' => self::getName()]);
        if (count($result[0]) != 0) {
            return $result[0]['id'];
        }
        return -1;
    }

    /**
     * @return string
     */
    public function getTmpFileName(): string
    {
        return $this->tmpFileName;
    }

    /**
     * @param string $tmpFileName
     */
    public function setTmpFileName(string $tmpFileName): void
    {
        $this->tmpFileName = $tmpFileName;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

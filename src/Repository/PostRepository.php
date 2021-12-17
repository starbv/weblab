<?php


namespace Repository;

include "src/Service/DatabaseService.php";
include "src/Entity/Post/PostDetail.php";
include "src/Entity/Post/PostPreview.php";

use Entity\Post\PostDetail;
use Entity\Post\PostPreview;
use Service\DatabaseService;

class PostRepository
{
    private DatabaseService $db;

    public function __construct()
    {
        $this->db = new DatabaseService();
    }

    public function getDetailPost(int $postId = 0): ?PostDetail
    {
        $sql = "select p.id, 
                        p.title, 
                        p.description,
                        p.create_date, 
                        (a.last_name || ' ' || substring(a.first_name, 1, 1) || '. ' || substring(a.patronymic, 1, 1) || '.') as account_name,
                        ph.path as account_image,
                        ph2.path as post_image,
                        (select count(*) from score s where s.post_id = p.id) as total_count_score,
                        (select avg(s.value) from score s where s.post_id = p.id) as avg_score
                from post as p
                inner join account a on a.id = p.account_id
                left join photo ph on ph.id = a.photo_id
                inner join photo ph2 on ph2.id = p.photo_id
                where p.id = :post_id";
        $result = $this->db->execSql($sql, ['post_id' => $postId]);
        if (!isset($result[0])) {
            return null;
        }
        return new PostDetail($result[0]);
    }

    public function getPreviewPosts(int $postId = 0): array
    {
        $result = [];
        $sql = "select p.id, 
                        p.title, 
                        p.create_date, 
                        (a.last_name || ' ' || substring(a.first_name, 1, 1) || '. ' || substring(a.patronymic, 1, 1) || '.') as account_name,
                        ph.path as account_image,
                        ph2.path as post_image
                from post as p
                inner join account a on a.id = p.account_id
                left join photo ph on ph.id = a.photo_id
                inner join photo ph2 on ph2.id = p.photo_id
                where p.id > :post_id
                order by p.id
                limit 15";
        $response = $this->db->execSql($sql, ['post_id' => $postId]);
        foreach ($response as $post) {
            $result[] = new PostPreview($post);
        }
        return $result;
    }
}

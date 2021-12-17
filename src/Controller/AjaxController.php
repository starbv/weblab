<?php


namespace Controller;

use Repository\PostRepository;

class AjaxController
{
    public static function loadMore(): array
    {
        $postId = $_POST['data'];
        if (isset($postId)) {
            if (intval($postId) >= 0) {
                $repo = new PostRepository();
                $posts = $repo->getPreviewPosts($postId);
                $data = [];
                foreach ($posts as $post) {
                    $data[] = $post->toArray();
                }
                $_SESSION['posts'] = $data;
                echo json_encode($data);
                return $data;
            }
        }
        return [];
    }
}

<?php


namespace Controller;

include "src/Repository/PostRepository.php";

use Repository\PostRepository;
use Service\RouterService;

class PostController
{
    public static function detailPost($postId = null)
    {
        if (isset($postId)) {
            if (intval($postId) >= 0) {
                $repo = new PostRepository();
                $post = $repo->getDetailPost($postId);
                if (!isset($post)) {
                    RouterService::redirectToPage('not_found');
                    die();
                }
                $_SESSION['detail_post'] = $post->toArray();
                RouterService::redirectToPage('detail_post');
            }
        }
        RouterService::redirectToPage('not_found');
    }
}

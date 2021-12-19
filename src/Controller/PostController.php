<?php


namespace Controller;

include "src/Repository/PostRepository.php";
include "src/Service/ValidationService.php";
include "src/Entity/Photo/PhotoCreate.php";
include "src/Entity/Post/PostCreate.php";
include "src/Entity/Score/ScoreCreate.php";

use Entity\Photo\PhotoCreate;
use Entity\Post\PostCreate;
use Entity\Score\ScoreCreate;
use Repository\PostRepository;
use Service\RouterService;
use Service\ValidationService;

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

    public static function create()
    {
        RouterService::redirectToPage('create_post');
        die();
    }

    public static function addScore()
    {
        if (!isset($_SESSION['user_id'])) {
            RouterService::redirectToPage('home');
            die();
        }
        $_SESSION['create_score_error'] = [];

        $data = [];
        $data['value'] = $_POST['scoreSelect'];
        $data['post_id'] = $_SESSION['detail_post']['id'];
        $data['account_id'] = $_SESSION['user_id'];

        $score = new ScoreCreate($data);
        $scoreId = $score->create();
        if ($scoreId == -1) {
            $_SESSION['create_score_error'] = ['Неудалось отставить оценку!'];
            RouterService::redirectToPage('detail_post');
            die();
        }
        RouterService::redirectToPage('detail_post');
        die();
    }

    public static function createPost()
    {
        $_SESSION['create_post_error'] = [];

        $data = [];
        $data['title'] = htmlspecialchars($_POST['title']);
        $data['description'] = htmlspecialchars($_POST['description']);
        $validator = new ValidationService();
        $resultValidate = $validator->validate($data);
        $fileError = $validator->validateFile($_FILES['file']);
        if (isset($fileError)) {
            $resultValidate[] = $fileError;
        }

        $_SESSION['create_post_error'] = $resultValidate;
        if (count($resultValidate) != 0) {
            RouterService::redirectToPage('create_post');
            die();
        }

        $photo = new PhotoCreate($_FILES['file']);
        $photoId = $photo->create();
        if ($photoId == -1) {
            $_SESSION['create_post_error'] = ['Неудалось сохранить фотографию!'];
            RouterService::redirectToPage('create_post');
            die();
        }

        $post = new PostCreate([
            'title' => $data['title'],
            'description' => $data['description'],
            'account_id' => $_SESSION['user_id'],
            'photo_id' => $photoId,
        ]);

        $postId = $post->create();
        if ($postId == -1) {
            $_SESSION['create_post_error'] = ['Неудалось создать пост!'];
            RouterService::redirectToPage('create_post');
            die();
        }
        $repo = new PostRepository();
        $post = $repo->getDetailPost($postId);
        $_SESSION['detail_post'] = $post->toArray();
        RouterService::redirectToPage('detail_post');
        die();
    }
}
